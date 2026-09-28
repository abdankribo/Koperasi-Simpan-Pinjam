import Link from "next/link";
import { redirect } from "next/navigation";
import { getSession } from "@/lib/auth";

export default async function MasterAdminLayout({ children }: { children: React.ReactNode }) {
  const session = await getSession();
  if (!session || session.role !== "master") redirect("/login");

  return (
    <>
      <aside className="sidebar">
        <div className="brand">DINKOPUM<br/><span>MASTER ADMIN</span></div>
        <nav>
          <Link href="/master-admin">⌂ &nbsp; Dashboard</Link>
          <Link href="/master-admin/kelompok">♟ &nbsp; Kelompok Master</Link>
          <Link href="/master-admin/akun">♙ &nbsp; Akun & Unit Master</Link>
          <Link href="/admin">⚙ &nbsp; Administrasi</Link>
          <a href="/logout">↪ &nbsp; Keluar</a>
        </nav>
      </aside>
      {children}
    </>
  );
}