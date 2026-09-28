"use server";
import { prisma } from "@/lib/prisma";
import { getSession } from "@/lib/auth";
import { redirect } from "next/navigation";

async function guard() {
  const s = await getSession();
  if (!s || s.role !== "master") redirect("/login");
}

export async function createKelompok(fd: FormData) {
  await guard();
  await prisma.masterKelompok.create({ data: { usernameMaster: String(fd.get("username") || ""), namaKelompok: String(fd.get("nama") || "") } });
  redirect("/master-admin/kelompok");
}

export async function deleteKelompok(fd: FormData) {
  await guard();
  await prisma.masterKelompok.delete({ where: { idMasterKel: Number(fd.get("id")) } });
  redirect("/master-admin/kelompok");
}

export async function createMaster(fd: FormData) {
  await guard();
  await prisma.masterAdmin.create({
    data: {
      usernameMaster: String(fd.get("username") || ""),
      passwordMaster: String(fd.get("password") || ""),
      unit: String(fd.get("unit") || "Koperasi")
    }
  });
  redirect("/master-admin/akun");
}

export async function deleteMaster(fd: FormData) {
  await guard();
  const id = Number(fd.get("id"));
  const count = await prisma.masterAdmin.count();
  if (count <= 1) redirect("/master-admin/akun");
  await prisma.masterAdmin.delete({ where: { idMaster: id } });
  redirect("/master-admin/akun");
}