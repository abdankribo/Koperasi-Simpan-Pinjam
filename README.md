# DINKOPUM BASEKOP — Next.js Migration

Repository ini sedang dimigrasikan dari aplikasi PHP native + MySQL/MariaDB menjadi aplikasi Next.js + TypeScript + Prisma.

## Status migrasi

- [x] Branch migrasi terpisah: `migration/nextjs`
- [x] Next.js App Router + TypeScript
- [x] Prisma schema yang memetakan database legacy
- [x] Fondasi koneksi Prisma
- [x] Autentikasi role-based: anggota, admin, master admin
- [x] Session berbasis HTTP-only JWT cookie
- [x] Password legacy plaintext dapat di-upgrade menjadi bcrypt setelah login berhasil
- [x] Migrasi modul utama admin (dashboard, anggota, simpanan, pinjaman, laporan, master, materi, dokumentasi, pengaturan)
- [x] Migrasi dashboard, simpanan, pinjaman, dan edit akun anggota
- [x] Migrasi dashboard dan kelompok master
- [x] CRUD pencatatan simpanan + histori
- [x] CRUD pencatatan pinjaman/angsuran + histori
- [x] Ringkasan laporan/neraca
- [x] Import anggota Excel/CSV
- [x] Data materi, dokumentasi, dan konfigurasi website
- [x] UI responsif dan dashboard role-based
- [ ] Pengujian build dan end-to-end
- [ ] Deployment Vercel

## Struktur database

Database legacy utama adalah `dinkopum_base`. Dump asli tetap dipertahankan sebagai referensi pada `dinkopum_base.sql`.

Model Prisma saat ini mencakup tabel:

`admin`, `anggota`, `aset_tetap`, `bank_record`, `beban`, `dokumentasi`, `ekuitas`, `ekuitas_record`, `kewajiban`, `list_kelompok`, `master_admin`, `master_kelompok`, `materi`, `pinjaman`, `pinjaman_record`, `set_web`, `shu`, `simpanan`, `simpanan_record`, dan `visi_misi`.

## Role

Aplikasi lama mempunyai tiga jalur login:

- **Anggota** → `/anggota`
- **Admin** → `/admin`
- **Master Admin** → `/master-admin`

Password yang tersimpan dalam database lama tidak perlu diubah manual terlebih dahulu. Saat akun lama berhasil login melalui Next.js, password akan diubah menjadi bcrypt secara otomatis.

## Development

Salin `.env.example` menjadi `.env`, kemudian isi:

```env
DATABASE_URL="mysql://USER:PASSWORD@HOST:3306/dinkopum_base"
AUTH_SECRET="gunakan-secret-random-yang-panjang"
```

Kemudian:

```bash
npm install
npx prisma generate
npm run dev
```

> Database production jangan diubah menggunakan `prisma db push` sebelum skema legacy dan strategi migrasi data diverifikasi.

<!-- production build verification -->
