import Link from "next/link";
import { redirect } from "next/navigation";
import { getSession } from "@/lib/auth";

export default async function AdminLayout({ children }: { children: React.ReactNode }) {
  const session = await getSession();
  if (!session || (session.role !== "admin" && session.role !== "master")) redirect("/login");

  return (
    <>
      <aside className="sidebar">
        <div className="brand">
          DINKOPUM
          <br />
          <span>BASEKOP • ADMIN</span>
        </div>
        <nav>
          {session.role === "master" && <Link href="/master-admin">← &nbsp; Kembali ke Master</Link>}
          <Link href="/admin">▦ &nbsp; Dashboard</Link>
          <Link href="/admin/anggota">♙ &nbsp; Anggota</Link>
          <Link href="/admin/simpanan">◉ &nbsp; Simpanan</Link>
          <Link href="/admin/pinjaman">▣ &nbsp; Pinjaman</Link>
          <Link href="/admin/riwayat/simpanan">↺ &nbsp; Riwayat Simpanan</Link>
          <Link href="/admin/riwayat/pinjaman">↺ &nbsp; Riwayat Pinjaman</Link>
          <Link href="/admin/keuangan">💵 &nbsp; Keuangan</Link>
          <Link href="/admin/laporan">▤ &nbsp; Laporan / Neraca</Link>
          <Link href="/admin/master-kelompok">⌘ &nbsp; Kelompok</Link>
          <Link href="/admin/materi">▥ &nbsp; Materi</Link>
          <Link href="/admin/dokumentasi">▧ &nbsp; Dokumentasi</Link>
          <Link href="/admin/pengaturan">⚙ &nbsp; Pengaturan</Link>
          <Link href="/admin/import">⇧ &nbsp; Import Excel</Link>
          <a href="/logout">↪ &nbsp; Keluar</a>
        </nav>
      </aside>
      {children}
    </>
  );
}
