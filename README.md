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
- [x] Production build verification via GitHub Actions
- [x] Role authorization and server-action guard verification
- [x] End-to-end testing against live database
- [x] Vercel project connection and deployment verification
- [x] Master Admin sebagai pusat kendali akun dan administrasi
- [x] Manajemen akun Master Admin, Admin, dan Anggota
- [x] Manajemen kelompok Master dan kelompok koperasi
- [x] Edit lengkap data anggota dan validasi data
- [x] Pencegahan username duplikat lintas role
- [x] Pencegahan nomor anggota duplikat
- [x] Nonaktifkan anggota tanpa menghapus riwayat transaksi
- [x] Administrasi Admin dapat diakses melalui panel Master Admin

## Struktur database

Database legacy utama adalah `dinkopum_base`. Dump asli tetap dipertahankan sebagai referensi pada `dinkopum_base.sql`.

Model Prisma saat ini mencakup tabel:

`admin`, `anggota`, `aset_tetap`, `bank_record`, `beban`, `dokumentasi`, `ekuitas`, `ekuitas_record`, `kewajiban`, `list_kelompok`, `master_admin`, `master_kelompok`, `materi`, `pinjaman`, `pinjaman_record`, `set_web`, `shu`, `simpanan`, `simpanan_record`, dan `visi_misi`.

## Role

Aplikasi lama mempunyai tiga jalur login:

- **Anggota** → `/anggota`
- **Admin** → `/admin`
- **Master Admin** → `/master-admin`

Build CI terbaru telah lulus (`npm install`, `prisma generate`, dan `next build`).

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

## Catatan verifikasi produksi

- Build production sudah diverifikasi pada GitHub Actions.
- Skema Prisma telah dipetakan terhadap dump `dinkopum_base.sql` yang ada di repository.
- Koneksi dan pengujian aplikasi terhadap database Railway production sudah dilakukan.
- Aplikasi sudah terhubung dan berjalan pada deployment Vercel.
- Alur login dan akses berdasarkan role sudah diverifikasi pada environment production.
- Fitur Master Admin sudah disiapkan sebagai pusat kendali akun dan administrasi sistem.

## Bootstrap Master Admin

Jika database belum memiliki akun pada tabel `master_admin`, jalankan perintah berikut dari environment yang terhubung ke database:

```bash
npm run db:seed-master
```

Secara default perintah tersebut membuat akun awal:

- Username: `master`
- Password: `master123`
- Unit: `Koperasi`

Untuk production, password dapat diganti tanpa mengubah source code dengan environment variable:

```env
MASTER_USERNAME=master
MASTER_PASSWORD=password-ku-yang-kuat
MASTER_UNIT=Koperasi
```

Script bersifat aman untuk dijalankan ulang: jika username tersebut sudah ada, script tidak membuat akun duplikat dan tidak mengganti password yang sudah ada.


## Akun Demo

Akun berikut disediakan khusus untuk demonstrasi aplikasi. Untuk keamanan, gunakan kredensial berbeda pada production.

| Peran | Username | Password | Keterangan |
|---|---|---|---|
| Master Admin | `master` | `master123` | Kendali penuh sistem |
| Admin | `admin-demo` | `admin123` | Administrasi koperasi |
| Kelompok | `Kelompok Demo` | — | Kelompok bukan jalur login; dikelola oleh Master Admin |
| Anggota | `anggota-demo` | `anggota123` | Akun anggota koperasi |

Jalur login:

- Master Admin → `/login` → setelah login menuju `/master-admin`
- Admin → `/login` → setelah login menuju `/admin`
- Anggota → `/login` → setelah login menuju `/anggota`
- Kelompok → bukan role login terpisah; data kelompok dikelola dari Master Admin.

Untuk membuat akun demo secara idempotent pada database yang sedang digunakan:

```bash
npm run db:seed-demo
```

Script hanya membuat data demo jika username/record tersebut belum ada dan tidak menimpa password akun yang sudah ada.

> Catatan: kredensial demo di atas ditujukan untuk development/staging/demo. Jangan gunakan password demo pada database production yang terbuka untuk publik.
