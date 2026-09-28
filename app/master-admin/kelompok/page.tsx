import Link from "next/link";
import { getSession } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { redirect } from "next/navigation";
import { createKelompok, deleteKelompok } from "../actions";

export default async function Page() {
  const s = await getSession();
  if (!s || s.role !== "master") redirect("/login");
  const rows = await prisma.masterKelompok.findMany({ orderBy: { idMasterKel: "asc" } });

  return (
    <main className="page">
      <section className="hero">
        <div><span className="eyebrow">MASTER ADMIN</span><h1>Kelompok Master</h1><p>Atur pemetaan kelompok dan akun master yang bertanggung jawab.</p></div>
        <Link className="btn light" href="/master-admin">Dashboard</Link>
      </section>
      <section className="card form-card">
        <div className="top"><div><h2>Tambah pemetaan kelompok</h2><p>Hubungkan nama kelompok dengan username master.</p></div></div>
        <form action={createKelompok} className="form-grid">
          <label>Nama kelompok<input name="nama" placeholder="Contoh: Kelompok Melati" required /></label>
          <label>Username master<input name="username" placeholder="Contoh: master" required /></label>
          <button className="btn" type="submit">+ Tambah Kelompok</button>
        </form>
      </section>
      <section className="card">
        <div className="top"><div><h2>Daftar kelompok</h2><p>{rows.length} pemetaan kelompok terdaftar.</p></div></div>
        <div className="table-wrap"><table><thead><tr><th>ID</th><th>Master</th><th>Kelompok</th><th>Aksi</th></tr></thead><tbody>
          {rows.length ? rows.map(x => <tr key={x.idMasterKel}><td>{x.idMasterKel}</td><td><span className="badge">{x.usernameMaster || "Belum ditentukan"}</span></td><td>{x.namaKelompok}</td><td><form action={deleteKelompok}><input type="hidden" name="id" value={x.idMasterKel}/><button className="danger">Hapus</button></form></td></tr>) : <tr><td colSpan={4}>Belum ada pemetaan kelompok.</td></tr>}
        </tbody></table></div>
      </section>
    </main>
  );
}