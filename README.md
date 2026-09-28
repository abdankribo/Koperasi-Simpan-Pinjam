# DINKOPUM BASEKOP — Sistem Koperasi Simpan Pinjam

Repository ini merupakan aplikasi koperasi simpan pinjam yang dimigrasikan dari PHP native + MySQL/MariaDB menjadi Next.js + TypeScript + Prisma.

Sistem mencakup pengelolaan anggota, akun pengguna, kelompok, simpanan, pinjaman, angsuran, keuangan, laporan, materi, dokumentasi, dan konfigurasi website.

Tiga role utama adalah **Anggota, Admin, dan Master Admin**. Anggota menggunakan portal pribadi, Admin menjalankan operasional koperasi, sedangkan Master Admin menjadi pusat kendali akun, kelompok, data anggota, dan administrasi sistem.

---

## Status sistem

- [x] Next.js App Router + TypeScript
- [x] Prisma + MySQL/Railway
- [x] Autentikasi role-based: Anggota, Admin, Master Admin
- [x] Session HTTP-only JWT cookie
- [x] Password bcrypt dan upgrade password legacy setelah login berhasil
- [x] Dashboard Anggota
- [x] Dashboard Admin
- [x] Dashboard Master Admin
- [x] Manajemen anggota
- [x] Manajemen akun Admin
- [x] Manajemen akun Master Admin
- [x] Manajemen kelompok Master dan kelompok koperasi
- [x] Pencatatan simpanan dan histori
- [x] Pencatatan pinjaman dan angsuran
- [x] Riwayat transaksi simpanan dan pinjaman
- [x] Modul keuangan
- [x] Laporan/neraca
- [x] Import anggota Excel/CSV
- [x] Materi pelatihan
- [x] Dokumentasi
- [x] Pengaturan informasi website
- [x] Validasi username duplikat lintas role
- [x] Validasi nomor anggota
- [x] Nonaktifkan anggota tanpa menghapus riwayat transaksi
- [x] Master Admin sebagai pusat kendali akun dan administrasi
- [x] Administrasi Admin dapat dibuka dari panel Master Admin
- [x] URL administrasi Master tetap berada di bawah /master-admin/administrasi
- [x] Production build verification via GitHub Actions
- [x] End-to-end testing terhadap database production
- [x] Railway production database
- [x] Vercel deployment
- [x] Verifikasi login dan authorization berdasarkan role

**Status keseluruhan: SELESAI / SIAP DIGUNAKAN.**

---

# 1. Gambaran umum sistem

Alur besar aplikasi:

**Login → validasi akun → pemeriksaan role → dashboard sesuai role → modul sesuai kewenangan → database → histori/laporan**

Secara konseptual:

**Anggota → Portal Anggota → Simpanan/Pinjaman/Akun**

**Admin → Dashboard Admin → Anggota/Simpanan/Pinjaman/Keuangan/Laporan/Konten**

**Master Admin → Dashboard Master → Akun/Kelompok/Anggota → Administrasi seluruh modul Admin**

Database utama menggunakan MySQL yang diakses melalui Prisma dan pada production menggunakan Railway.

---

# 2. Alur login dan authorization

Semua role menggunakan halaman login yang sama.

Alurnya:

1. Pengguna membuka /login.
2. Pengguna memasukkan username dan password.
3. Sistem mencari akun sesuai data yang tersedia.
4. Password diverifikasi.
5. Jika password legacy masih plaintext dan login berhasil, sistem dapat melakukan upgrade ke bcrypt.
6. Sistem membuat session JWT HTTP-only.
7. Role dimasukkan ke session.
8. Pengguna diarahkan ke area sesuai role.

Tujuan redirect:

- Master Admin → /master-admin
- Admin → /admin
- Anggota → /anggota

Role yang digunakan:

- anggota
- admin
- master

Pengguna tanpa session valid tidak dapat mengakses area yang membutuhkan autentikasi.

---

# 3. Role Anggota

## Tujuan

Role Anggota merupakan portal pribadi anggota koperasi. Fokusnya adalah melihat informasi milik sendiri, bukan menjalankan administrasi koperasi.

## Dashboard Anggota

Dashboard menampilkan:

- Nama anggota
- Nomor anggota
- Status anggota
- Unit
- Total simpanan
- Informasi pinjaman
- Transaksi simpanan terbaru
- Aktivitas pinjaman terbaru

## Simpanan

Anggota dapat melihat data simpanan miliknya:

- Simpanan pokok
- Simpanan wajib
- Simpanan sukarela
- Simpanan hari raya
- Simpanan khusus

Anggota juga dapat melihat histori transaksi simpanan.

## Pinjaman

Anggota dapat melihat:

- Pokok pinjaman
- Jasa pinjaman
- Pinjaman khusus
- Angsuran pokok
- Angsuran jasa
- Histori aktivitas pinjaman

## Akun

Anggota dapat mengakses informasi akun/profil yang tersedia pada portal.

## Batas akses Anggota

Anggota tidak dapat:

- Mengelola anggota lain
- Mengubah transaksi anggota lain
- Mengelola akun Admin
- Mengelola akun Master
- Mengelola kelompok
- Mengelola keuangan koperasi
- Mengubah konfigurasi administrasi

---

# 4. Role Admin

## Tujuan

Admin merupakan role operasional. Admin digunakan oleh petugas/karyawan koperasi untuk menjalankan kegiatan administrasi sehari-hari.

Jalur utama: /login → /admin

## Dashboard Admin

Dashboard menyediakan ringkasan:

- Total anggota
- Jumlah data simpanan
- Jumlah data pinjaman
- Modul administrasi koperasi

## Data Anggota

Admin dapat mengelola data anggota sesuai fungsi modul:

- Nomor anggota
- Nama
- Username
- Koperasi
- NIK
- Jabatan
- Unit
- Nomor telepon
- Email
- Alamat
- Tempat lahir
- Tanggal lahir
- Jenis kelamin
- Status
- Keterangan
- Password akun

## Simpanan

Modul ini digunakan untuk:

- Mencatat simpanan
- Mengelola kategori simpanan
- Melihat data simpanan
- Menyimpan histori transaksi

Kategori yang tersedia meliputi pokok, wajib, sukarela, hari raya, dan khusus.

## Pinjaman

Modul ini digunakan untuk:

- Mencatat pinjaman
- Mencatat jasa
- Mencatat pinjaman khusus
- Mencatat angsuran
- Melihat histori pinjaman
- Melihat histori pembayaran

## Riwayat

Terdapat modul riwayat simpanan dan riwayat pinjaman untuk melihat transaksi yang sudah tersimpan.

## Keuangan

Modul keuangan mencakup:

- Bank/kas
- Beban
- Aset tetap
- Ekuitas
- Kewajiban
- SHU

## Laporan / Neraca

Menyajikan ringkasan kondisi keuangan koperasi berdasarkan data keuangan yang tersedia.

## Kelompok

Digunakan untuk mengelola daftar kelompok koperasi.

## Materi

Digunakan untuk mengelola materi pelatihan, tanggal pelatihan, dan dokumen materi.

## Dokumentasi

Digunakan untuk mengelola dokumentasi/gambar kegiatan koperasi.

## Pengaturan

Digunakan untuk mengelola informasi website/koperasi, antara lain:

- Nama koperasi
- Deskripsi
- Alamat
- Nomor telepon
- Email
- Logo

## Import Excel / CSV

Digunakan untuk memasukkan data anggota secara massal melalui file Excel atau CSV.

---

# 5. Role Master Admin

## Tujuan

Master Admin adalah role dengan kewenangan tertinggi pada aplikasi.

Master Admin memiliki panel khusus dan bukan sekadar Admin biasa. Master Admin dapat mengendalikan akun, struktur kelompok, data anggota, serta mengakses seluruh administrasi operasional.

Jalur utama: /login → /master-admin

## Navigasi Master Admin

- Dashboard
- Kelompok Master
- Akun & Unit Master
- Administrasi
- Keluar

## Dashboard Master Admin

Dashboard menjadi pusat kendali untuk menuju seluruh fungsi Master Admin.

## Kelompok Master

Master Admin dapat:

- Membuat kelompok
- Mengubah kelompok
- Menghapus kelompok yang aman untuk dihapus
- Mengatur data kelompok Master

## Akun Master Admin

Master Admin dapat:

- Menambah Master Admin
- Mengubah username
- Mengubah unit
- Mengubah password
- Menghapus akun
- Melindungi akun Master terakhir agar tidak terhapus

## Akun Admin

Master Admin dapat:

- Menambah Admin
- Mengubah username
- Mengubah password
- Menghapus Admin
- Memastikan username tidak bentrok dengan role lain

## Data Anggota

Master Admin dapat:

- Menambah anggota
- Mengubah anggota
- Mengubah nomor anggota
- Mengubah username
- Mengubah password
- Mengubah identitas
- Mengubah koperasi
- Mengubah unit
- Mengubah jabatan
- Mengubah NIK
- Mengubah telepon
- Mengubah email
- Mengubah alamat
- Mengubah tempat lahir
- Mengubah jenis kelamin
- Mengubah status
- Mengubah keterangan
- Menonaktifkan anggota

---

# 6. Administrasi dari Master Admin

Master Admin mempunyai menu Administrasi pada:

/master-admin/administrasi

Alurnya:

Master Admin → Administrasi → modul Admin

Modul yang dapat diakses:

- Anggota
- Simpanan
- Pinjaman
- Riwayat Simpanan
- Riwayat Pinjaman
- Keuangan
- Laporan
- Kelompok
- Materi
- Dokumentasi
- Pengaturan
- Import

Modul Admin digunakan kembali secara internal sehingga implementasi tidak perlu diduplikasi.

Dari sisi pengguna, Master Admin tetap berada pada jalur /master-admin/administrasi.

Jika Master Admin mencoba membuka /admin secara langsung, middleware mengarahkannya kembali ke jalur administrasi Master.

Dengan pola ini:

- Panel Master tetap menjadi pusat kontrol.
- Modul operasional tetap menggunakan fungsi Admin.
- Admin biasa tetap menggunakan /admin.
- Master Admin dapat menjalankan fungsi operasional tanpa kehilangan identitas role Master.

---

# 7. Perbandingan fungsi role

| Fitur | Anggota | Admin | Master Admin |
|---|:---:|:---:|:---:|
| Login | ✓ | ✓ | ✓ |
| Dashboard pribadi | ✓ | - | - |
| Dashboard Admin | - | ✓ | ✓ |
| Dashboard Master | - | - | ✓ |
| Lihat profil sendiri | ✓ | - | - |
| Kelola anggota | - | ✓ | ✓ |
| Simpanan | Lihat | ✓ | ✓ |
| Pinjaman | Lihat | ✓ | ✓ |
| Riwayat transaksi | Sendiri | ✓ | ✓ |
| Keuangan | - | ✓ | ✓ |
| Laporan/neraca | - | ✓ | ✓ |
| Kelompok | - | ✓ | ✓ |
| Import anggota | - | ✓ | ✓ |
| Materi | - | ✓ | ✓ |
| Dokumentasi | - | ✓ | ✓ |
| Pengaturan website | - | ✓ | ✓ |
| Kelola akun Admin | - | - | ✓ |
| Kelola akun Master | - | - | ✓ |
| Kelola struktur Master | - | - | ✓ |
| Administrasi melalui panel Master | - | - | ✓ |

**Lihat** pada Simpanan/Pinjaman berarti Anggota hanya melihat data miliknya sendiri.

---

# 8. Alur sistem utama

## A. Pembuatan anggota

Master/Admin
→ tambah anggota
→ isi identitas dan akun
→ validasi nomor anggota
→ validasi username lintas role
→ password di-hash
→ simpan database
→ anggota dapat login

## B. Alur simpanan

Anggota terdaftar
→ Admin mencatat simpanan
→ data simpanan diperbarui
→ record transaksi disimpan
→ Admin dapat melihat histori
→ Anggota dapat melihat data miliknya

## C. Alur pinjaman

Anggota
→ pinjaman dicatat Admin
→ pokok dan jasa dicatat
→ pinjaman tersimpan
→ angsuran dicatat
→ record pinjaman tersimpan
→ histori dipantau
→ Anggota melihat data pinjaman

## D. Alur keuangan

Transaksi koperasi
→ simpanan/pinjaman
→ bank/kas
→ beban
→ aset
→ ekuitas
→ kewajiban
→ laporan/neraca
→ SHU

---

# 9. Alur pengelolaan akun

Master Admin menjadi pusat pengelolaan akun.

Master Admin
→ Akun Master
→ Akun Admin
→ Data Anggota
→ database

Setiap pembuatan atau perubahan username diperiksa terhadap tiga kelompok akun:

- Master Admin
- Admin
- Anggota

Dengan demikian username yang sudah digunakan pada satu role tidak boleh dipakai lagi pada role lain.

Password baru disimpan menggunakan bcrypt.

---

# 10. Alur status anggota

Status anggota mengikuti pola:

Aktif → dinonaktifkan → Tidak Aktif

Ketika anggota dinonaktifkan:

- Akun tidak dapat digunakan sebagai anggota aktif.
- Data anggota tetap berada di database.
- Histori simpanan tetap tersedia.
- Histori pinjaman tetap tersedia.
- Data transaksi tidak perlu dihapus.

Tujuan utamanya adalah menjaga kesinambungan data historis koperasi.

---

# 11. Struktur database

Database utama menggunakan MySQL dan diakses melalui Prisma.

Model yang tersedia:

- admin
- anggota
- aset_tetap
- bank_record
- beban
- dokumentasi
- ekuitas
- ekuitas_record
- kewajiban
- list_kelompok
- master_admin
- master_kelompok
- materi
- pinjaman
- pinjaman_record
- set_web
- shu
- simpanan
- simpanan_record
- visi_misi

| Kelompok | Model |
|---|---|
| Akun | admin, master_admin, anggota |
| Kelompok | list_kelompok, master_kelompok |
| Simpanan | simpanan, simpanan_record |
| Pinjaman | pinjaman, pinjaman_record |
| Keuangan | bank_record, beban, aset_tetap, ekuitas, ekuitas_record, kewajiban, shu |
| Konten | materi, dokumentasi, visi_misi, set_web |

---

# 12. Keamanan dan validasi

Sistem menerapkan:

- Authentication melalui session login.
- Authorization berdasarkan role.
- HTTP-only JWT cookie.
- Password bcrypt.
- Validasi username lintas role.
- Validasi nomor anggota.
- Perlindungan agar akun Master/Admin terakhir tidak dihapus.
- Nonaktifkan anggota tanpa menghapus histori transaksi.
- Server-side guard pada fungsi administrasi.

---

# 13. Struktur alur halaman

## Anggota

/login
→ /anggota
→ Simpanan
→ Pinjaman
→ Akun

## Admin

/login
→ /admin
→ Anggota
→ Simpanan
→ Pinjaman
→ Riwayat Simpanan
→ Riwayat Pinjaman
→ Keuangan
→ Laporan
→ Kelompok
→ Materi
→ Dokumentasi
→ Pengaturan
→ Import

## Master Admin

/login
→ /master-admin
→ Dashboard
→ Kelompok Master
→ Akun & Unit Master
→ Administrasi
→ seluruh modul Admin

---

# 14. Teknologi

- Next.js
- React
- TypeScript
- Prisma ORM
- MySQL
- Railway
- Vercel
- JWT
- HTTP-only cookie
- bcrypt
- GitHub Actions

---

# 15. Development

Salin .env.example menjadi .env dan isi:

DATABASE_URL="mysql://USER:PASSWORD@HOST:3306/dinkopum_base"
AUTH_SECRET="gunakan-secret-random-yang-panjang"

Install:

npm install

Generate Prisma Client:

npx prisma generate

Jalankan development:

npm run dev

Build production:

npm run build

> Database production jangan diubah menggunakan prisma db push sebelum skema legacy dan strategi migrasi data diverifikasi.

---

# 16. Bootstrap Master Admin

Jika database belum mempunyai akun Master Admin:

npm run db:seed-master

Default:

| Field | Nilai |
|---|---|
| Username | master |
| Password | master123 |
| Unit | Koperasi |

Untuk production:

MASTER_USERNAME=master
MASTER_PASSWORD=password-ku-yang-kuat
MASTER_UNIT=Koperasi

Script aman dijalankan ulang. Jika username Master tersebut sudah ada, script tidak membuat akun duplikat dan tidak mengganti password yang sudah tersimpan.

---

# 17. Akun Demo

| Peran | Username | Password | Keterangan |
|---|---|---|---|
| Master Admin | master | master123 | Kendali sistem |
| Admin | admin | admin123 | Operasional koperasi |
| Anggota | anggota01 | anggota123 | Portal anggota |
| Kelompok | Kelompok Demo | — | Bukan akun login |

Buat data demo:

npm run db:seed-demo

Jalur login:

- Master Admin → /login → /master-admin
- Admin → /login → /admin
- Anggota → /login → /anggota
- Kelompok → bukan role login

> Jangan gunakan password demo pada database production yang terbuka untuk publik.

---

# 18. Verifikasi production

- Build production sudah diverifikasi melalui GitHub Actions.
- Prisma Client berhasil digenerate pada proses build.
- Database production menggunakan Railway.
- Aplikasi telah terhubung dan diuji terhadap database production.
- Deployment aplikasi tersedia melalui Vercel.
- Login berdasarkan role telah diverifikasi.
- Authorization Admin, Anggota, dan Master Admin telah diterapkan.
- Panel Master Admin dan administrasi telah disiapkan.
- Pengelolaan akun dan data anggota telah dilengkapi validasi.
- Histori transaksi anggota dipertahankan ketika anggota dinonaktifkan.

---

# 19. Ringkasan alur sistem

Alur utama sistem dapat digambarkan sebagai berikut:

```text
                         ┌───────────────┐
                         │     LOGIN     │
                         └───────┬───────┘
                                 │
                                 ▼
                       ┌───────────────────┐
                       │  Validasi Akun    │
                       └─────────┬─────────┘
                                 │
                                 ▼
                       ┌───────────────────┐
                       │ Pemeriksaan Role  │
                       └─────────┬─────────┘
                                 │
          ┌──────────────────────┼──────────────────────┐
          │                      │                      │
          ▼                      ▼                      ▼
   ┌─────────────┐       ┌─────────────┐       ┌────────────────┐
   │   ANGGOTA   │       │    ADMIN    │       │  MASTER ADMIN  │
   └──────┬──────┘       └──────┬──────┘       └───────┬────────┘
          │                      │                      │
          ▼                      ▼                      ▼
   • Simpanan             • Data Anggota         • Kelompok Master
   • Pinjaman             • Simpanan             • Akun Master
   • Riwayat              • Pinjaman             • Akun Admin
   • Kelola Akun          • Riwayat              • Data Anggota
                          • Keuangan             • Administrasi
                          • Laporan
                          • Kelompok
                          • Materi & Dokumentasi
                          • Pengaturan
```

Semua data diproses melalui Prisma → MySQL/Railway.

Data transaksi kemudian dapat digunakan untuk histori, administrasi keuangan, laporan/neraca, dan pengelolaan SHU.

---

## Kesimpulan fungsi sistem

Sistem memisahkan tiga tingkat penggunaan:

1. **Anggota** berfokus pada data pribadi, simpanan, pinjaman, dan histori miliknya.
2. **Admin** berfokus pada operasional koperasi: anggota, transaksi, keuangan, laporan, kelompok, konten, dan import data.
3. **Master Admin** menjadi pusat kendali: akun Master, akun Admin, data anggota, kelompok Master, validasi akun, serta akses ke seluruh administrasi Admin.

Dengan pembagian tersebut, alur kerja menjadi jelas dari **pengelolaan akun → data anggota → transaksi simpanan/pinjaman → histori → keuangan → laporan**, dengan Master Admin sebagai pengendali struktur dan hak akses sistem.
