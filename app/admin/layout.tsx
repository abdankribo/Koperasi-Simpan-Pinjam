import Link from "next/link";
import { redirect } from "next/navigation";
import { getSession } from "@/lib/auth";

export default async function AdminLayout({ children }: { children: React.ReactNode }) {
  const session = await getSession();
  if (!session || session.role !== "admin") redirect("/login");

  return (
    <>
      <aside className="sidebar">
        <div className="brand">DINKOPUM<br/><span>BASEKOP</span></div>
        <nav>
          <Link href="/admin">Dashboard</Link>
          <Link href="/admin/anggota">Anggota</Link>
          <Link href="/admin/simpanan">Simpanan</Link>
          <Link href="/admin/pinjaman">Pinjaman</Link>
          <Link href="/admin/riwayat/simpanan">Riwayat Simpanan</Link>
          <Link href="/admin/riwayat/pinjaman">Riwayat Pinjaman</Link>
          <Link href="/admin/laporan">Laporan / Neraca</Link>
          <Link href="/admin/master-kelompok">Kelompok</Link>
          <Link href="/admin/materi">Materi</Link>
          <Link href="/admin/dokumentasi">Dokumentasi</Link>
          <Link href="/admin/pengaturan">Pengaturan</Link>
          <Link href="/admin/import">Import Excel</Link>
          <a href="/logout">Keluar</a>
        </nav>
      </aside>
      {children}
    </>
  );
}