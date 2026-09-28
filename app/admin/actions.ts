"use server";
import { prisma } from "@/lib/prisma";
import { getSession } from "@/lib/auth";
import { redirect } from "next/navigation";
import bcrypt from "bcryptjs";

async function guard() {
  const s = await getSession();
  if (!s || (s.role !== "admin" && s.role !== "master")) redirect("/login");
  return s;
}

const n = (v: any) => Math.max(0, Number(v || 0));

export async function createAnggota(fd: FormData) {
  await guard();
  const nomor = String(fd.get("nomor") || "").trim();
  const username = String(fd.get("username") || nomor).trim();
  if (!nomor) redirect("/admin/anggota?error=nomor");
  const exists = await prisma.anggota.findFirst({
    where: { OR: [{ nomorAnggota: nomor }, { usernameUser: username }] },
  });
  if (exists) redirect("/admin/anggota?error=duplikat");
  const password = String(fd.get("password") || nomor);

  await prisma.anggota.create({
    data: {
      nomorAnggota: nomor,
      nama: String(fd.get("nama") || ""),
      koperasiUser: String(fd.get("koperasi") || ""),
      usernameUser: username,
      passwordUser: await bcrypt.hash(password, 12),
      nik: String(fd.get("nik") || ""),
      jabatanAnggota: String(fd.get("jabatan") || ""),
      unit: String(fd.get("unit") || ""),
      alamat: String(fd.get("alamat") || ""),
      email: String(fd.get("email") || ""),
      nomorTelepon: String(fd.get("telepon") || ""),
      tempatLahir: String(fd.get("tempatLahir") || ""),
      tanggalLahir: fd.get("tanggalLahir") ? new Date(String(fd.get("tanggalLahir"))) : null,
      jenisKelamin: String(fd.get("jenisKelamin") || ""),
      statusAnggota: String(fd.get("status") || "Aktif"),
      lastUpdate: Math.floor(Date.now() / 1000),
    },
  });
  redirect("/admin/anggota");
}

export async function updateAnggota(fd: FormData) {
  await guard();
  const id = n(fd.get("id"));
  const username = String(fd.get("username") || "").trim();
  const exists = await prisma.anggota.findFirst({ where: { usernameUser: username, NOT: { id } } });
  if (exists) redirect("/admin/anggota/" + id + "?error=username");

  const data: any = {
    nama: String(fd.get("nama") || ""),
    usernameUser: username,
    unit: String(fd.get("unit") || ""),
    jabatanAnggota: String(fd.get("jabatan") || ""),
    nik: String(fd.get("nik") || ""),
    nomorTelepon: String(fd.get("telepon") || ""),
    email: String(fd.get("email") || ""),
    alamat: String(fd.get("alamat") || ""),
    statusAnggota: String(fd.get("status") || "Aktif"),
    lastUpdate: Math.floor(Date.now() / 1000),
  };

  const p = String(fd.get("password") || "");
  if (p) data.passwordUser = await bcrypt.hash(p, 12);
  await prisma.anggota.update({ where: { id }, data });
  redirect("/admin/anggota/" + id);
}

export async function deactivateAnggota(fd: FormData) {
  await guard();
  await prisma.anggota.update({
    where: { id: n(fd.get("id")) },
    data: { statusAnggota: "Tidak Aktif", lastUpdate: Math.floor(Date.now() / 1000) },
  });
  redirect("/admin/anggota");
}

export async function deleteAnggota(fd: FormData) {
  await deactivateAnggota(fd);
}

export async function createSimpanan(fd: FormData) {
  await guard();
  const nomor = String(fd.get("nomor") || "").trim();
  const a = await prisma.anggota.findFirst({
    where: { nomorAnggota: nomor, statusAnggota: "Aktif" },
  });
  if (!a) redirect("/admin/simpanan?error=anggota");

  const vals = {
    pokok: n(fd.get("pokok")),
    wajib: n(fd.get("wajib")),
    sukarela: n(fd.get("sukarela")),
    hariraya: n(fd.get("hariraya")),
    khusus: n(fd.get("khusus")),
  };
  if (Object.values(vals).every((v) => v === 0)) redirect("/admin/simpanan?error=nominal");

  const old = await prisma.simpanan.findFirst({ where: { nomorAnggota: nomor } });
  await prisma.$transaction(async (tx) => {
    if (old) {
      await tx.simpanan.update({
        where: { idSmp: old.idSmp },
        data: {
          spokok: { increment: vals.pokok },
          swajib: { increment: vals.wajib },
          ssukarela: { increment: vals.sukarela },
          shariraya: { increment: vals.hariraya },
          skhusus: { increment: vals.khusus },
        },
      });
    } else {
      await tx.simpanan.create({
        data: {
          nomorAnggota: nomor,
          namaAnggota: a.nama,
          unit: a.unit,
          spokok: vals.pokok,
          swajib: vals.wajib,
          ssukarela: vals.sukarela,
          shariraya: vals.hariraya,
          skhusus: vals.khusus,
        },
      });
    }

    await tx.simpananRecord.create({
      data: {
        idAnggota: nomor,
        pokokRec: vals.pokok,
        wajibRec: vals.wajib,
        sukarelaRec: vals.sukarela,
        harirayaRec: vals.hariraya,
        khususRec: vals.khusus,
        tglSimpanan: new Date(),
        bulan: String(new Date().getMonth() + 1).padStart(2, "0"),
      },
    });
  });
  redirect("/admin/simpanan");
}

export async function createPinjaman(fd: FormData) {
  await recordPencairan(fd);
}

export async function recordPencairan(fd: FormData) {
  await guard();
  const nomor = String(fd.get("nomor") || "").trim();
  const a = await prisma.anggota.findFirst({ where: { nomorAnggota: nomor } });
  if (!a) redirect("/admin/pinjaman?error=anggota");

  const v = {
    pokok: n(fd.get("pokok")),
    jasa: n(fd.get("jasa")),
    khususPokok: n(fd.get("khususPokok")),
    khususJasa: n(fd.get("khususJasa")),
  };
  if (v.pokok + v.jasa + v.khususPokok + v.khususJasa === 0) redirect("/admin/pinjaman?error=nominal");

  const old = await prisma.pinjaman.findFirst({ where: { nomorAnggota: nomor } });
  await prisma.$transaction(async (tx) => {
    if (old) {
      await tx.pinjaman.update({
        where: { idPinjaman: old.idPinjaman },
        data: {
          pinjamanPokok: { increment: v.pokok },
          pinjamanJasa: { increment: v.jasa },
          pinjamanKhususPokok: { increment: v.khususPokok },
          pinjamanKhususJasa: { increment: v.khususJasa },
        },
      });
    } else {
      await tx.pinjaman.create({
        data: {
          nomorAnggota: nomor,
          namaAnggota: a.nama || "",
          unit: a.unit,
          pinjamanPokok: v.pokok,
          pinjamanJasa: v.jasa,
          pinjamanKhususPokok: v.khususPokok,
          pinjamanKhususJasa: v.khususJasa,
          angsuranPokok: 0,
          angsuranJasa: 0,
        },
      });
    }

    await tx.pinjamanRecord.create({
      data: {
        idAnggota: nomor,
        pinjamanPokokRec: v.pokok,
        pinjamanJasaRec: v.jasa,
        pinjamanKhususPokok: v.khususPokok,
        pinjamanKhususJasa: v.khususJasa,
        angsuranPokok: 0,
        angsuranJasa: 0,
        tanggalPinjaman: new Date(),
        bulan: String(new Date().getMonth() + 1).padStart(2, "0"),
      },
    });
  });
  redirect("/admin/pinjaman");
}

export async function recordAngsuran(fd: FormData) {
  await guard();
  const nomor = String(fd.get("nomor") || "").trim();
  const pokok = n(fd.get("angsuranPokok"));
  const jasa = n(fd.get("angsuranJasa"));
  const old = await prisma.pinjaman.findFirst({ where: { nomorAnggota: nomor } });
  if (!old || pokok + jasa === 0) redirect("/admin/pinjaman?error=angsuran");

  const sisaPokok = Number(old.pinjamanPokok || 0) + Number(old.pinjamanKhususPokok || 0);
  const sisaJasa = Number(old.pinjamanJasa || 0) + Number(old.pinjamanKhususJasa || 0);
  if (pokok > sisaPokok || jasa > sisaJasa) redirect("/admin/pinjaman?error=melebihi");

  const bayarPokokNormal = Math.min(pokok, Number(old.pinjamanPokok || 0));
  const bayarPokokKhusus = pokok - bayarPokokNormal;
  const bayarJasaNormal = Math.min(jasa, Number(old.pinjamanJasa || 0));
  const bayarJasaKhusus = jasa - bayarJasaNormal;

  await prisma.$transaction(async (tx) => {
    await tx.pinjaman.update({
      where: { idPinjaman: old.idPinjaman },
      data: {
        pinjamanPokok: { decrement: bayarPokokNormal },
        pinjamanKhususPokok: { decrement: bayarPokokKhusus },
        pinjamanJasa: { decrement: bayarJasaNormal },
        pinjamanKhususJasa: { decrement: bayarJasaKhusus },
        angsuranPokok: { increment: pokok },
        angsuranJasa: { increment: jasa },
      },
    });
    await tx.pinjamanRecord.create({
      data: {
        idAnggota: nomor,
        pinjamanPokokRec: 0,
        pinjamanJasaRec: 0,
        pinjamanKhususPokok: 0,
        pinjamanKhususJasa: 0,
        angsuranPokok: pokok,
        angsuranJasa: jasa,
        tanggalPinjaman: new Date(),
        bulan: String(new Date().getMonth() + 1).padStart(2, "0"),
      },
    });
  });
  redirect("/admin/pinjaman");
}

export async function deleteSimpanan(fd: FormData) {
  await guard();
  await prisma.simpanan.delete({ where: { idSmp: n(fd.get("id")) } });
  redirect("/admin/simpanan");
}

export async function deletePinjaman(fd: FormData) {
  await guard();
  await prisma.pinjaman.delete({ where: { idPinjaman: n(fd.get("id")) } });
  redirect("/admin/pinjaman");
}
