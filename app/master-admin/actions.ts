"use server";

import { prisma } from "@/lib/prisma";
import { getSession } from "@/lib/auth";
import { redirect } from "next/navigation";
import bcrypt from "bcryptjs";

async function guard() {
  const s = await getSession();
  if (!s || s.role !== "master") redirect("/login");
}

const text = (fd: FormData, key: string) => String(fd.get(key) || "").trim();

export async function createKelompok(fd: FormData) {
  await guard();
  const nama = text(fd, "nama");
  const username = text(fd, "username");
  if (!nama || !username) redirect("/master-admin/akun?error=kelompok");
  await prisma.masterKelompok.create({
    data: { usernameMaster: username, namaKelompok: nama },
  });
  redirect("/master-admin/akun");
}

export async function updateKelompok(fd: FormData) {
  await guard();
  const id = Number(fd.get("id"));
  const nama = text(fd, "nama");
  const username = text(fd, "username");
  if (!id || !nama || !username) redirect("/master-admin/akun?error=kelompok");
  await prisma.masterKelompok.update({
    where: { idMasterKel: id },
    data: { usernameMaster: username, namaKelompok: nama },
  });
  redirect("/master-admin/akun");
}

export async function deleteKelompok(fd: FormData) {
  await guard();
  await prisma.masterKelompok.delete({ where: { idMasterKel: Number(fd.get("id")) } });
  redirect("/master-admin/akun");
}

export async function createMaster(fd: FormData) {
  await guard();
  const username = text(fd, "username");
  const password = String(fd.get("password") || "");
  if (!username || password.length < 6) redirect("/master-admin/akun?error=password");
  const exists = await prisma.masterAdmin.findFirst({ where: { usernameMaster: username } });
  if (exists) redirect("/master-admin/akun?error=duplikat");
  await prisma.masterAdmin.create({
    data: {
      usernameMaster: username,
      passwordMaster: await bcrypt.hash(password, 12),
      unit: text(fd, "unit") || "Koperasi",
    },
  });
  redirect("/master-admin/akun");
}

export async function updateMaster(fd: FormData) {
  await guard();
  const id = Number(fd.get("id"));
  const username = text(fd, "username");
  const exists = await prisma.masterAdmin.findFirst({
    where: { usernameMaster: username, NOT: { idMaster: id } },
  });
  if (exists) redirect("/master-admin/akun?error=duplikat");
  const data: { usernameMaster: string; unit: string; passwordMaster?: string } = {
    usernameMaster: username,
    unit: text(fd, "unit") || "Koperasi",
  };
  const password = String(fd.get("password") || "");
  if (password) data.passwordMaster = await bcrypt.hash(password, 12);
  await prisma.masterAdmin.update({ where: { idMaster: id }, data });
  redirect("/master-admin/akun");
}

export async function deleteMaster(fd: FormData) {
  await guard();
  const id = Number(fd.get("id"));
  const count = await prisma.masterAdmin.count();
  if (count <= 1) redirect("/master-admin/akun?error=terakhir");
  await prisma.masterAdmin.delete({ where: { idMaster: id } });
  redirect("/master-admin/akun");
}

export async function createAdmin(fd: FormData) {
  await guard();
  const username = text(fd, "username");
  const password = String(fd.get("password") || "");
  if (!username || password.length < 6) redirect("/master-admin/akun?error=admin_password");
  const exists = await prisma.admin.findFirst({ where: { usernameAdmin: username } });
  if (exists) redirect("/master-admin/akun?error=admin_duplikat");
  await prisma.admin.create({
    data: {
      usernameAdmin: username,
      passwordAdmin: await bcrypt.hash(password, 12),
    },
  });
  redirect("/master-admin/akun");
}

export async function updateAdmin(fd: FormData) {
  await guard();
  const id = Number(fd.get("id"));
  const username = text(fd, "username");
  if (!id || !username) redirect("/master-admin/akun?error=admin_username");
  const exists = await prisma.admin.findFirst({
    where: { usernameAdmin: username, NOT: { idAdmin: id } },
  });
  if (exists) redirect("/master-admin/akun?error=admin_duplikat");
  const data: { usernameAdmin: string; passwordAdmin?: string } = { usernameAdmin: username };
  const password = String(fd.get("password") || "");
  if (password) {
    if (password.length < 6) redirect("/master-admin/akun?error=admin_password");
    data.passwordAdmin = await bcrypt.hash(password, 12);
  }
  await prisma.admin.update({ where: { idAdmin: id }, data });
  redirect("/master-admin/akun");
}

export async function deleteAdmin(fd: FormData) {
  await guard();
  const id = Number(fd.get("id"));
  const count = await prisma.admin.count();
  if (count <= 1) redirect("/master-admin/akun?error=admin_terakhir");
  await prisma.admin.delete({ where: { idAdmin: id } });
  redirect("/master-admin/akun");
}

export async function createAnggotaMaster(fd: FormData) {
  await guard();
  const nomor = text(fd, "nomor");
  const username = text(fd, "username") || nomor;
  const password = String(fd.get("password") || nomor);
  if (!nomor || !username) redirect("/master-admin/akun?error=anggota");
  const exists = await prisma.anggota.findFirst({
    where: { OR: [{ nomorAnggota: nomor }, { usernameUser: username }] },
  });
  if (exists) redirect("/master-admin/akun?error=anggota_duplikat");
  await prisma.anggota.create({
    data: {
      nomorAnggota: nomor,
      nama: text(fd, "nama"),
      koperasiUser: text(fd, "koperasi"),
      usernameUser: username,
      passwordUser: await bcrypt.hash(password, 12),
      nik: text(fd, "nik"),
      jabatanAnggota: text(fd, "jabatan"),
      unit: text(fd, "unit"),
      alamat: text(fd, "alamat"),
      nomorTelepon: text(fd, "telepon"),
      email: text(fd, "email"),
      jenisKelamin: text(fd, "jenisKelamin"),
      statusAnggota: text(fd, "status") || "Aktif",
      lastUpdate: Math.floor(Date.now() / 1000),
    },
  });
  redirect("/master-admin/akun");
}

export async function updateAnggotaMaster(fd: FormData) {
  await guard();
  const id = Number(fd.get("id"));
  const username = text(fd, "username");
  if (!id || !username) redirect("/master-admin/akun?error=anggota_username");
  const exists = await prisma.anggota.findFirst({
    where: { usernameUser: username, NOT: { id } },
  });
  if (exists) redirect("/master-admin/akun?error=anggota_duplikat");
  const data: any = {
    nama: text(fd, "nama"),
    usernameUser: username,
    unit: text(fd, "unit"),
    jabatanAnggota: text(fd, "jabatan"),
    nik: text(fd, "nik"),
    nomorTelepon: text(fd, "telepon"),
    email: text(fd, "email"),
    alamat: text(fd, "alamat"),
    statusAnggota: text(fd, "status") || "Aktif",
    lastUpdate: Math.floor(Date.now() / 1000),
  };
  const password = String(fd.get("password") || "");
  if (password) data.passwordUser = await bcrypt.hash(password, 12);
  await prisma.anggota.update({ where: { id }, data });
  redirect("/master-admin/akun");
}

// "Hapus" anggota memakai status Tidak Aktif agar seluruh histori simpanan/pinjaman
// tetap terhubung dan tidak merusak laporan koperasi.
export async function deleteAnggotaMaster(fd: FormData) {
  await guard();
  await prisma.anggota.update({
    where: { id: Number(fd.get("id")) },
    data: { statusAnggota: "Tidak Aktif", lastUpdate: Math.floor(Date.now() / 1000) },
  });
  redirect("/master-admin/akun");
}
