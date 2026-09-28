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
- [ ] Migrasi seluruh halaman admin
- [ ] Migrasi seluruh halaman anggota
- [ ] Migrasi seluruh halaman master admin
- [ ] Migrasi CRUD simpanan
- [ ] Migrasi CRUD pinjaman
- [ ] Migrasi laporan/neraca
- [ ] Migrasi import Excel
- [ ] Migrasi upload dokumen/gambar
- [ ] Modernisasi UI/UX
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