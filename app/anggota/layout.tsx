import Link from "next/link";
import { redirect } from "next/navigation";
import { getSession } from "@/lib/auth";

export default async function AnggotaLayout({ children }: { children: React.ReactNode }) {
  const session = await getSession();
  if (!session || session.role !== "anggota") redirect("/login");

  return (
    <>
      <aside className="sidebar">
        <div className="brand">DINKOPUM<br/><span>ANGGOTA</span></div>
        <nav>
          <Link href="/anggota">Dashboard</Link>
          <Link href="/anggota/simpanan">Simpanan Saya</Link>
          <Link href="/anggota/pinjaman">Pinjaman Saya</Link>
          <Link href="/anggota/akun">Akun Saya</Link>
          <a href="/logout">Keluar</a>
        </nav>
      </aside>
      {children}
    </>
  );
}