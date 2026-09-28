import { getSession } from "@/lib/auth";
import { redirect } from "next/navigation";

export default async function MasterAdminPage() {
  const session = await getSession();
  if (!session || session.role !== "master") redirect("/login");
  return <main style={{ padding: 32 }}><h1>Master Admin Dashboard</h1><p>Area master admin disiapkan untuk modul pihak ketiga dan pengelolaan unit/kelompok.</p></main>;
}