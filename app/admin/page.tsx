import Link from "next/link";
import { getSession } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { redirect } from "next/navigation";

export default async function AdminPage() {
  const s = await getSession();
  if (!s || (s.role !== "admin" && s.role !== "master")) redirect("/login");

  const [anggota, simpanan, pinjaman] = await Promise.all([
    prisma.anggota.count(),
    prisma.simpanan.count(),
    prisma.pinjaman.count(),
  ]);

  return (
    <main className="page">
      <section className="hero">
        <div>
          <span className="eyebrow">ADMINISTRATOR • BASEKOP</span>
          <h1>Dashboard Koperasi</h1>
          <p>Kelola anggota, transaksi, laporan, dan konten koperasi dari satu tempat.</p>
        </div>
        <a className="btn light" href="/logout">Keluar</a>
      </section>

      <div className="stats">
        <div className="stat">
          <small>Total anggota</small>
          <strong>{anggota}</strong>
          <Link href="/admin/anggota">Kelola anggota →</Link>
        </div>
        <div className="stat">
          <small>Data simpanan</small>
          <strong>{simpanan}</strong>
          <Link href="/admin/simpanan">Buka simpanan →</Link>
        </div>
        <div className="stat">
          <small>Data pinjaman</small>
          <strong>{pinjaman}</strong>
          <Link href="/admin/pinjaman">Buka pinjaman →</Link>
        </div>
      </div>

      <section className="card">
        <div className="top">
          <div>
            <span className="eyebrow">MENU UTAMA</span>
            <h2>Modul administrasi</h2>
            <p>Pilih fitur yang ingin dikelola.</p>
          </div>
        </div>
        <div className="grid">
          <Link className="module" href="/admin/anggota">
            <b>👥 Data Anggota</b>
            <span>Kelola identitas, akun, unit, dan status anggota.</span>
          </Link>
          <Link className="module" href="/admin/simpanan">
            <b>💰 Simpanan</b>
            <span>Catat dan pantau simpanan pokok, wajib, sukarela, dan lainnya.</span>
          </Link>
          <Link className="module" href="/admin/pinjaman">
            <b>📄 Pinjaman</b>
            <span>Kelola pinjaman, jasa, dan pembayaran angsuran.</span>
          </Link>
          <Link className="module" href="/admin/riwayat/simpanan">
            <b>↺ Riwayat Simpanan</b>
            <span>Lihat histori transaksi simpanan anggota.</span>
          </Link>
          <Link className="module" href="/admin/riwayat/pinjaman">
            <b>↺ Riwayat Pinjaman</b>
            <span>Lihat histori pinjaman dan angsuran.</span>
          </Link>
          <Link className="module" href="/admin/laporan">
            <b>📊 Laporan / Neraca</b>
            <span>Ringkasan kondisi keuangan koperasi.</span>
          </Link>
          <Link className="module" href="/admin/master-kelompok">
            <b>⌘ Kelompok</b>
            <span>Kelola daftar kelompok koperasi.</span>
          </Link>
          <Link className="module" href="/master-admin">
            <b>⚙️ Master Admin</b>
            <span>Kelola unit dan akses administrasi.</span>
          </Link>
          <Link className="module" href="/admin/materi">
            <b>📚 Materi</b>
            <span>Kelola materi pelatihan koperasi.</span>
          </Link>
          <Link className="module" href="/admin/dokumentasi">
            <b>🖼️ Dokumentasi</b>
            <span>Kelola dokumentasi dan konten visual.</span>
          </Link>
          <Link className="module" href="/admin/pengaturan">
            <b>⚙️ Pengaturan</b>
            <span>Atur informasi dan identitas website.</span>
          </Link>
          <Link className="module" href="/admin/import">
            <b>⇧ Import Excel</b>
            <span>Masukkan data anggota dari Excel atau CSV.</span>
          </Link>
        </div>
      </section>
    </main>
  );
}
