import Link from "next/link";
import { getSession } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { redirect } from "next/navigation";

export default async function Page() {
  const s = await getSession();
  if (!s || s.role !== "master") redirect("/login");

  const [master, groups, anggota, simpanan, pinjaman, admin] = await Promise.all([
    prisma.masterAdmin.count(),
    prisma.masterKelompok.count(),
    prisma.anggota.count(),
    prisma.simpanan.count(),
    prisma.pinjaman.count(),
    prisma.admin.count(),
  ]);

  return (
    <main className="page">
      <section className="hero">
        <div>
          <span className="eyebrow">MASTER ADMIN • PENGELOLA SISTEM</span>
          <h1>Dashboard Master Admin</h1>
          <p>Pusat pengelolaan struktur, akun master, dan pemantauan kondisi koperasi.</p>
        </div>
        <a className="btn light" href="/logout">Keluar</a>
      </section>

      <div className="stats">
        <div className="stat"><small>Akun Master</small><strong>{master}</strong><Link href="/master-admin/akun">Kelola akun →</Link></div>
        <div className="stat"><small>Pemetaan Kelompok</small><strong>{groups}</strong><Link href="/master-admin/kelompok">Kelola kelompok →</Link></div>
        <div className="stat"><small>Akun Admin</small><strong>{admin}</strong><Link href="/admin">Buka administrasi →</Link></div>
      </div>

      <section className="card">
        <div className="top">
          <div>
            <span className="eyebrow">PUSAT KONTROL</span>
            <h2>Manajemen Master</h2>
            <p>Kelola struktur organisasi dan akses pengelola tanpa mencampurkannya dengan transaksi harian.</p>
          </div>
        </div>
        <div className="grid">
          <Link className="module" href="/master-admin/kelompok">
            <b>♟ Kelompok Master</b>
            <span>Buat dan kelola pemetaan kelompok untuk setiap akun master.</span>
          </Link>
          <Link className="module" href="/master-admin/akun">
            <b>♙ Akun & Unit Master</b>
            <span>Kelola username, unit kerja, dan akun pengelola tingkat master.</span>
          </Link>
          <Link className="module" href="/admin">
            <b>⚙ Administrasi Operasional</b>
            <span>Akses dashboard Admin untuk memantau dan mengelola operasional koperasi.</span>
          </Link>
          <div className="module">
            <b>◉ Monitoring Koperasi</b>
            <span>{anggota} anggota • {simpanan} data simpanan • {pinjaman} data pinjaman tersedia di sistem.</span>
          </div>
        </div>
      </section>

      <section className="card" style={{marginTop:16}}>
        <div className="top">
          <div>
            <span className="eyebrow">RINGKASAN SISTEM</span>
            <h2>Status data koperasi</h2>
            <p>Ringkasan jumlah data yang sedang dikelola sistem.</p>
          </div>
        </div>
        <div className="master-overview">
          <div><small>Anggota</small><strong>{anggota}</strong><span>data anggota terdaftar</span></div>
          <div><small>Simpanan</small><strong>{simpanan}</strong><span>data saldo anggota</span></div>
          <div><small>Pinjaman</small><strong>{pinjaman}</strong><span>data pembiayaan anggota</span></div>
        </div>
      </section>
    </main>
  );
}