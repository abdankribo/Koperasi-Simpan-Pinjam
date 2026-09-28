import { getSession } from "@/lib/auth";
import { redirect } from "next/navigation";

export default async function AdminPage() {
  const session = await getSession();
  if (!session || session.role !== "admin") redirect("/login");
  return <main style={{ padding: 32 }}><h1>Admin Dashboard</h1><p>Fondasi dashboard admin aktif. Modul anggota, simpanan, pinjaman, laporan, materi, dan pengaturan akan dipindahkan berikutnya.</p></main>;
}