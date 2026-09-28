import Link from "next/link";
import { getSession } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { redirect } from "next/navigation";
import { createMaster, deleteMaster } from "../actions";

export default async function Page() {
  const s = await getSession();
  if (!s || s.role !== "master") redirect("/login");
  const rows = await prisma.masterAdmin.findMany({ orderBy: { idMaster: "asc" } });

  return (
    <main className="page">
      <section className="hero">
        <div><span className="eyebrow">MASTER ADMIN</span><h1>Akun & Unit Master</h1><p>Kelola akun pengelola tingkat master dan unit kerjanya.</p></div>
        <Link className="btn light" href="/master-admin">Dashboard</Link>
      </section>

      <section className="card form-card">
        <div className="top"><div><h2>Tambah akun master</h2><p>Buat akun baru untuk pengelola sistem tingkat master.</p></div></div>
        <form action={createMaster} className="form-grid">
          <label>Username master<input name="username" placeholder="Username" required /></label>
          <label>Password<input name="password" type="password" placeholder="Password" required minLength={6} /></label>
          <label>Unit kerja<input name="unit" placeholder="Contoh: Unit A" required /></label>
          <button className="btn" type="submit">+ Tambah Akun</button>
        </form>
      </section>

      <section className="card">
        <div className="top"><div><h2>Daftar akun master</h2><p>{rows.length} akun terdaftar. Minimal satu akun master dipertahankan agar sistem tetap dapat dikelola.</p></div></div>
        <div className="table-wrap"><table><thead><tr><th>ID</th><th>Username</th><th>Unit</th><th>Peran</th><th>Aksi</th></tr></thead><tbody>
          {rows.map(x => <tr key={x.idMaster}><td>{x.idMaster}</td><td><strong>{x.usernameMaster}</strong></td><td>{x.unit}</td><td><span className="badge">MASTER</span></td><td><form action={deleteMaster}><input type="hidden" name="id" value={x.idMaster}/><button className="danger" disabled={rows.length === 1}>Hapus</button></form></td></tr>)}
        </tbody></table></div>
      </section>
    </main>
  );
}