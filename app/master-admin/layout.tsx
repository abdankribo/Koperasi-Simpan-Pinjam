import Link from "next/link";
import { redirect } from "next/navigation";
import { getSession } from "@/lib/auth";

export default async function MasterAdminLayout({ children }: { children: React.ReactNode }) {
  const session = await getSession();
  if (!session || session.role !== "master") redirect("/login");

  return (
    <>
      <aside className="sidebar">
        <div className="brand">DINKOPUM<br/><span>MASTER</span></div>
        <nav>
          <Link href="/master-admin">Dashboard</Link>
          <Link href="/master-admin/kelompok">Kelompok Master</Link>
          <a href="/logout">Keluar</a>
        </nav>
      </aside>
      {children}
    </>
  );
}