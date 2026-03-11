# Dokumentasi Lengkap - Sistem Informasi SDIT Labitech Insan Mulia

Dokumen ini adalah ringkasan dari seluruh dokumentasi proyek, menggabungkan semua file `.md` menjadi satu panduan terpusat.

---

## 1. 🚀 Tentang Proyek

Website resmi **SDIT Labitech Insan Mulia** yang mencakup:

- Landing page sekolah (Beranda, Tentang Kami, Berita, Kontak)
- Pendaftaran Siswa Baru (PPDB) & Siswa Pindahan
- Portal Siswa (login & dashboard)
- Panel Admin (manajemen data siswa)
- Sistem login terpadu (Unified Login) untuk Siswa & Admin

**Tech Stack:**

- **Framework:** Laravel 11
- **Frontend:** Blade, Bootstrap 5, Font Awesome 6
- **Database:** MySQL
- **Auth:** Multi-guard (Admin + Students)

---

## 2. ⚙️ Instalasi dan Setup

**Persyaratan:**

- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Node.js & NPM

**Langkah-langkah:**

```bash
# 1. Clone repository
git clone <repo-url> sekolah
cd sekolah

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
DB_DATABASE=sekolah
DB_USERNAME=root
DB_PASSWORD=

# 5. Jalankan migrasi dan seeder
php artisan migrate --seed

# 6. Build assets & jalankan server
npm run build
php artisan serve
```

Akses website di `http://localhost:8000`.

---

## 3. 🔐 Akun Login

### 👨‍💼 Admin (Login sebagai Admin)

Gunakan halaman `/login` dan pilih "Admin".

| Username        | Email                  | Password       |
| --------------- | ---------------------- | -------------- |
| `labitech`      | admin@labitech.sch.id  | `secret123`    |
| `kepalasekolah` | kepsek@labitech.sch.id | `labitech2026` |
| `tatausaha`     | tu@labitech.sch.id     | `admin12345`   |

### 🎓 Siswa (Login sebagai Siswa)

Gunakan halaman `/login` dan pilih "Siswa". Siswa bisa login menggunakan **NISN**, **Username**, atau **Email**.

| Nama           | Username        | NISN         | Password   |
| -------------- | --------------- | ------------ | ---------- |
| Ahmad Fauzi    | `ahmadfauzi`    | `1234567890` | `siswa123` |
| Siti Nurhaliza | `sitinurhaliza` | `0987654321` | `siswa123` |

---

## 4. ✨ Fitur Utama

### a. Unified Login System

Sistem login terpadu di `/login` untuk siswa dan admin dengan carousel fitur.

- **Controller**: `app/Http/Controllers/UnifiedLoginController.php`
- **View**: `resources/views/auth/unified-login.blade.php`
- **Fitur**: Toggle Siswa/Admin, form dinamis, dan desain responsif.

### b. Portal Siswa

Platform lengkap bagi siswa untuk mengelola informasi mereka.

- **Registrasi Mandiri**: Siswa mendaftar di `/student-register`.
- **Login dengan NISN**: Menggunakan NISN sebagai kredensial utama.
- **Dashboard & Profil**: Melihat data pribadi, akademik, dan keluarga.
- **Status Kelulusan**: Memantau status kelulusan secara real-time.
- **Controller**: `app/Http/Controllers/StudentController.php` & `StudentAuthController.php`.

### c. Pendaftaran Siswa Pindahan

Selain pendaftaran siswa baru, sistem juga mendukung pendaftaran siswa pindahan.

- **URL**: `/pendaftaran-pindahan`
- **Fitur**: Form pendaftaran khusus, upload dokumen (rapor, surat pindah), dan manajemen status oleh admin.
- **Controller**: `app/Http/Controllers/PendaftaranPindahanController.php`

### d. Import Data Siswa

Admin dapat mengimpor data siswa secara massal dari file Excel.

- **Controller**: `app/Http/Controllers/StudentImportController.php`
- **Format**: File `format_siswa.xlsx` disediakan sebagai template.
- **Proses**: Sistem akan memvalidasi dan memasukkan data ke dalam tabel `students`.

### e. Integrasi WhatsApp

Sistem dirancang untuk dapat diintegrasikan dengan notifikasi WhatsApp (misalnya via Twilio) untuk pembaruan status siswa.

- **Contoh Notifikasi**: `app/Notifications/StudentStatusUpdated.php`

---

## 5. 🧪 Panduan Testing

1.  **Jalankan Migrasi & Seeder**: `php artisan migrate --seed`
2.  **Akses Halaman Login**: Buka `http://localhost:8000/login`.
3.  **Test Login Admin**: Gunakan kredensial admin di atas. Verifikasi akses ke dashboard admin.
4.  **Test Login Siswa**: Gunakan kredensial siswa di atas. Verifikasi akses ke dashboard siswa.
5.  **Test Registrasi Siswa**: Buka `/student-register`, isi form, dan pastikan auto-login ke dashboard siswa berhasil.
6.  **Test Pendaftaran Pindahan**: Buka `/pendaftaran-pindahan`, isi form, dan cek datanya di panel admin.
7.  **Verifikasi Responsivitas**: Buka halaman-halaman utama di berbagai ukuran layar.

---

## 6. 🏗️ Struktur & Kustomisasi

- **Routes**: Didefinisikan di `routes/web.php`.
- **Views**: Terletak di `resources/views/`.
    - **Layout Utama**: `layouts/app.blade.php` (untuk frontend) dan `layouts/admin.blade.php` (untuk panel admin).
    - **Halaman**: `index.blade.php`, `about.blade.php`, dll.
- **Controllers**: Logika aplikasi berada di `app/Http/Controllers/`.
- **Models**: Representasi tabel database ada di `app/Models/`.
- **Kustomisasi Warna & Tampilan**: Sebagian besar styling CSS berada langsung di file-file `.blade.php` atau di `resources/css/app.css` untuk styling global.
