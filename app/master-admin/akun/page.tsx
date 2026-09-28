import Link from "next/link";
import { getSession } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { redirect } from "next/navigation";
import {
  createAdmin, updateAdmin, deleteAdmin,
  createAnggotaMaster, updateAnggotaMaster, deleteAnggotaMaster,
  createMaster, updateMaster, deleteMaster,
  createKelompok, updateKelompok, deleteKelompok, createListKelompok, updateListKelompok, deleteListKelompok,
} from "../actions";

export default async function Page({ searchParams }: { searchParams: Promise<{ error?: string }> }) {
  const s = await getSession();
  if (!s || s.role !== "master") redirect("/login");
  const q = await searchParams;

  const [masters, admins, groups, listGroups, anggota] = await Promise.all([
    prisma.masterAdmin.findMany({ orderBy: { idMaster: "asc" } }),
    prisma.admin.findMany({ orderBy: { idAdmin: "asc" } }),
    prisma.masterKelompok.findMany({ orderBy: { idMasterKel: "asc" } }),
    prisma.listKelompok.findMany({ orderBy: { idKelompok: "asc" } }),
    prisma.anggota.findMany({ orderBy: { id: "asc" } }),
  ]);

  const errorText: Record<string, string> = {
    duplikat: "Username Master sudah digunakan.",
    password: "Password Master minimal 6 karakter.",
    terakhir: "Minimal harus ada satu akun Master.",
    admin_duplikat: "Username Admin sudah digunakan.",
    admin_password: "Password Admin minimal 6 karakter.",
    admin_terakhir: "Minimal harus ada satu akun Admin.",
    kelompok: "Nama kelompok dan username Master wajib diisi.",
    anggota: "Nomor anggota wajib diisi.",
    anggota_duplikat: "Nomor anggota atau username anggota sudah digunakan.",
    anggota_username: "Username anggota wajib diisi.",
  };

  return (
    <main className="page">
      <section className="hero">
        <div>
          <span className="eyebrow">MASTER ADMIN • KENDALI SISTEM</span>
          <h1>Akun & Unit Master</h1>
          <p>Master Admin memiliki kendali penuh atas akun Admin, kelompok, dan akun anggota koperasi.</p>
        </div>
        <Link className="btn light" href="/master-admin">Dashboard</Link>
      </section>

      {q.error && <section className="card" style={{ marginTop: 16, color: "#b42318" }}>
        {errorText[q.error] || "Perubahan belum disimpan. Periksa data yang dimasukkan."}
      </section>}

      <section className="card">
        <div className="top">
          <div><span className="eyebrow">1 • AKUN ADMIN</span><h2>Kelola akun Admin</h2><p>Tambah, ubah username, ubah password, atau hapus akun Admin.</p></div>
        </div>
        <form action={createAdmin} className="form-grid">
          <label>Username Admin<input name="username" required /></label>
          <label>Password Admin<input name="password" type="password" minLength={6} required /></label>
          <button className="btn">+ Tambah Admin</button>
        </form>
        <div className="table-wrap" style={{ marginTop: 16 }}>
          <table><thead><tr><th>ID</th><th>Username</th><th>Ubah akun</th><th>Aksi</th></tr></thead><tbody>
            {admins.map(x => <tr key={x.idAdmin}>
              <td>{x.idAdmin}</td><td><strong>{x.usernameAdmin}</strong></td>
              <td><details><summary>Edit username / password</summary>
                <form action={updateAdmin} className="form-grid" style={{ marginTop: 10 }}>
                  <input type="hidden" name="id" value={x.idAdmin} />
                  <label>Username<input name="username" defaultValue={x.usernameAdmin} required /></label>
                  <label>Password baru<input name="password" type="password" minLength={6} placeholder="Kosongkan jika tidak diubah" /></label>
                  <button className="btn">Simpan perubahan</button>
                </form>
              </details></td>
              <td><form action={deleteAdmin}><input type="hidden" name="id" value={x.idAdmin}/><button className="danger" disabled={admins.length === 1}>Hapus</button></form></td>
            </tr>)}
          </tbody></table>
        </div>
      </section>

      <section className="card">
        <div className="top"><div><span className="eyebrow">2 • KELOMPOK</span><h2>Kelola kelompok</h2><p>Kelompok Master dapat ditambah, diedit, dan dihapus dari pusat kendali.</p></div></div>
        <form action={createKelompok} className="form-grid">
          <label>Nama kelompok<input name="nama" required placeholder="Contoh: Kelompok Melati" /></label>
          <label>Username Master<input name="username" required placeholder="Contoh: master" /></label>
          <button className="btn">+ Tambah Kelompok</button>
        </form>
        <div className="table-wrap" style={{ marginTop: 16 }}>
          <table><thead><tr><th>ID</th><th>Master</th><th>Kelompok</th><th>Ubah</th><th>Aksi</th></tr></thead><tbody>
            {groups.map(x => <tr key={x.idMasterKel}>
              <td>{x.idMasterKel}</td><td>{x.usernameMaster}</td><td>{x.namaKelompok}</td>
              <td><details><summary>Edit</summary><form action={updateKelompok} className="form-grid" style={{ marginTop: 10 }}>
                <input type="hidden" name="id" value={x.idMasterKel}/>
                <label>Nama<input name="nama" defaultValue={x.namaKelompok} required /></label>
                <label>Master<input name="username" defaultValue={x.usernameMaster} required /></label>
                <button className="btn">Simpan</button>
              </form></details></td>
              <td><form action={deleteKelompok}><input type="hidden" name="id" value={x.idMasterKel}/><button className="danger">Hapus</button></form></td>
            </tr>)}
          </tbody></table>
        </div>
      </section>

      <section className="card">
        <div className="top"><div><span className="eyebrow">3 • DATA KELOMPOK KOPERASI</span><h2>Kelola master kelompok</h2><p>Ini adalah daftar kelompok operasional yang dipakai modul administrasi koperasi.</p></div></div>
        <form action={createListKelompok} className="form-grid">
          <label>Nama kelompok<input name="nama" required /></label>
          <button className="btn">+ Tambah Kelompok</button>
        </form>
        <div className="table-wrap" style={{ marginTop: 16 }}>
          <table><thead><tr><th>ID</th><th>Nama Kelompok</th><th>Edit</th><th>Aksi</th></tr></thead><tbody>
            {listGroups.map(x => <tr key={x.idKelompok}><td>{x.idKelompok}</td><td>{x.namaKelompok}</td>
              <td><details><summary>Edit</summary><form action={updateListKelompok} className="form-grid" style={{marginTop:10}}><input type="hidden" name="id" value={x.idKelompok}/><label>Nama<input name="nama" defaultValue={x.namaKelompok} required/></label><button className="btn">Simpan</button></form></details></td>
              <td><form action={deleteListKelompok}><input type="hidden" name="id" value={x.idKelompok}/><button className="danger">Hapus</button></form></td>
            </tr>)}
          </tbody></table>
        </div>
      </section>

      <section className="card">
        <div className="top"><div><span className="eyebrow">4 • ANGGOTA KOPERASI</span><h2>Kelola akun & data anggota</h2><p>Username, password, identitas, unit, dan status anggota dapat dikendalikan Master Admin.</p></div></div>
        <form action={createAnggotaMaster} className="form-grid">
          <label>Nomor anggota<input name="nomor" required /></label>
          <label>Nama<input name="nama" required /></label>
          <label>Username<input name="username" required /></label>
          <label>Password<input name="password" type="password" placeholder="Kosongkan untuk memakai nomor anggota" /></label>
          <label>Unit<input name="unit" /></label>
          <label>NIK<input name="nik" /></label>
          <label>Jabatan<input name="jabatan" /></label>
          <label>Telepon<input name="telepon" /></label>
          <label>Email<input name="email" type="email" /></label>
          <label>Status<select name="status"><option>Aktif</option><option>Tidak Aktif</option></select></label>
          <label>Jenis kelamin<select name="jenisKelamin"><option>Laki-Laki</option><option>Perempuan</option></select></label>
          <label className="full">Alamat<textarea name="alamat" /></label>
          <button className="btn">+ Tambah Anggota</button>
        </form>

        <div className="table-wrap" style={{ marginTop: 16 }}>
          <table><thead><tr><th>Nomor</th><th>Nama</th><th>Username</th><th>Unit</th><th>Status</th><th>Edit</th><th>Aksi</th></tr></thead><tbody>
            {anggota.map(x => <tr key={x.id}>
              <td>{x.nomorAnggota || "-"}</td><td>{x.nama || "-"}</td><td>{x.usernameUser || "-"}</td><td>{x.unit || "-"}</td><td><span className="badge">{x.statusAnggota || "-"}</span></td>
              <td><details><summary>Edit</summary><form action={updateAnggotaMaster} className="form-grid" style={{ marginTop: 10 }}>
                <input type="hidden" name="id" value={x.id}/>
                <label>Nama<input name="nama" defaultValue={x.nama || ""} required /></label>
                <label>Username<input name="username" defaultValue={x.usernameUser || ""} required /></label>
                <label>NIK<input name="nik" defaultValue={x.nik || ""} /></label>
                <label>Unit<input name="unit" defaultValue={x.unit || ""} /></label>
                <label>Jabatan<input name="jabatan" defaultValue={x.jabatanAnggota || ""} /></label>
                <label>Telepon<input name="telepon" defaultValue={x.nomorTelepon || ""} /></label>
                <label>Email<input name="email" defaultValue={x.email || ""} /></label>
                <label>Status<select name="status" defaultValue={x.statusAnggota || "Aktif"}><option>Aktif</option><option>Tidak Aktif</option></select></label>
                <label>Password baru<input name="password" type="password" placeholder="Kosongkan jika tidak diubah" /></label>
                <label className="full">Alamat<textarea name="alamat" defaultValue={x.alamat || ""}/></label>
                <button className="btn">Simpan perubahan</button>
              </form></details></td>
              <td><form action={deleteAnggotaMaster}><input type="hidden" name="id" value={x.id}/><button className="danger" disabled={x.statusAnggota === "Tidak Aktif"}>Nonaktifkan</button></form></td>
            </tr>)}
          </tbody></table>
        </div>
      </section>

      <section className="card">
        <span className="eyebrow">5 • AKUN MASTER</span>
        <h2>Kelola akun Master</h2>
        <p>Akun Master tetap dikelola di sini. Password selalu disimpan sebagai hash bcrypt.</p>
        <form action={createMaster} className="form-grid" style={{ marginTop: 12 }}>
          <label>Username<input name="username" required /></label><label>Password<input name="password" type="password" minLength={6} required /></label><label>Unit kerja<input name="unit" defaultValue="Koperasi" required /></label><button className="btn">+ Tambah Master</button>
        </form>
        <div className="table-wrap" style={{ marginTop: 16 }}><table><thead><tr><th>ID</th><th>Username</th><th>Unit</th><th>Edit</th><th>Aksi</th></tr></thead><tbody>
          {masters.map(x => <tr key={x.idMaster}><td>{x.idMaster}</td><td>{x.usernameMaster}</td><td>{x.unit}</td><td><details><summary>Edit</summary><form action={updateMaster} className="form-grid" style={{marginTop:10}}><input type="hidden" name="id" value={x.idMaster}/><label>Username<input name="username" defaultValue={x.usernameMaster} required/></label><label>Unit<input name="unit" defaultValue={x.unit} required/></label><label>Password baru<input name="password" type="password" minLength={6} placeholder="Kosongkan"/></label><button className="btn">Simpan</button></form></details></td><td><form action={deleteMaster}><input type="hidden" name="id" value={x.idMaster}/><button className="danger" disabled={masters.length===1}>Hapus</button></form></td></tr>)}
        </tbody></table></div>
      </section>
    </main>
  );
}
