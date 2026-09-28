import { getSession } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { redirect } from "next/navigation";

export default async function AnggotaPage() {
  const session = await getSession();
  if (!session || session.role !== "anggota") redirect("/login");
  const user = await prisma.anggota.findUnique({ where: { id: Number(session.userId) } });
  return <main style={{ padding: 32 }}><h1>Dashboard Anggota</h1><p>Selamat datang, {user?.nama || "Anggota"}.</p><p>Modul akun, keuangan, simpanan, pinjaman, dokumen, dan riwayat akan dipindahkan berikutnya.</p></main>;
}