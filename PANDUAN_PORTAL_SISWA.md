# 📚 Panduan Portal Siswa SDIT Labitech Insan Mulia

## 1. Ringkasan Fitur

Portal Siswa adalah platform yang memungkinkan siswa untuk:

- ✅ **Registrasi Mandiri** - Siswa dapat mendaftar sendiri tanpa memerlukan intervensi admin
- ✅ **Login dengan NISN** - Siswa login menggunakan NISN dan password
- ✅ **Dashboard Personal** - Tampilan beranda dengan informasi akademik
- ✅ **Profil Lengkap** - Melihat semua data diri, keluarga, dan orang tua
- ✅ **Status Kelulusan** - Melihat status kelulusan (pending/dihubungi/lulus/tidak lulus)
- ✅ **Notifikasi WhatsApp** - Menerima pemberitahuan via WhatsApp untuk update status
- ✅ **Download Sertifikat** - Mengunduh sertifikat kelulusan (jika lulus)

---

## 2. Akses Portal Siswa

### URL Portal

```
https://sekolah.sch.id/student-login
```

### Menu Navigasi Utama

Di navbar (bagian atas halaman), akan ada tombol:

- **Login Admin** - Untuk login sebagai admin/staff
- **Login Siswa** - Untuk login sebagai siswa (warna hijau)

---

## 3. Alur Registrasi Siswa

### Step 1: Ke Halaman Registrasi

1. Klik tombol **"Login Siswa"** di navbar
2. Pada halaman login, klik **"Daftar di sini"** atau akses `https://sekolah.sch.id/student-register`

### Step 2: Isi Form Registrasi

Form registrasi meminta data berikut:

| Field               | Format               | Contoh                |
| ------------------- | -------------------- | --------------------- |
| Nama Lengkap        | Teks                 | Ahmad Rifki Rahman    |
| NISN                | 10 digit             | 1234567890            |
| NIS                 | Teks (opsional)      | 12345                 |
| Jenis Kelamin       | L / P                | L                     |
| Tempat Lahir        | Teks                 | Jakarta               |
| Tanggal Lahir       | dd/mm/yyyy           | 15/01/2010            |
| No. HP              | 08xxxxxxxxxx         | 081234567890          |
| Email               | Email                | ahmad.rifki@email.com |
| Password            | Min 6 karakter       | MyPassword123         |
| Konfirmasi Password | Sama dengan password | MyPassword123         |

### Step 3: Submit & Auto-Login

- Sistem akan **auto-generate username** dari nama siswa
- Password akan di-hash dengan bcrypt
- Siswa akan **otomatis login** setelah registrasi berhasil
- Redirect ke dashboard siswa

---

## 4. Alur Login Siswa

### Step 1: Buka Halaman Login

Akses `https://sekolah.sch.id/student-login`

### Step 2: Isi Form Login

- **NISN**: Masukkan NISN (10 digit) - contoh: 1234567890
- **Password**: Masukkan password yang digunakan saat registrasi
- **Remember Me**: Centang jika ingin tetap login

### Step 3: Login

Klik tombol **"Masuk"** untuk login.

---

## 5. Dashboard Siswa

Setelah login, siswa akan melihat:

### Informasi Cepat (Cards)

- **Status Akademik** - Status siswa (Aktif/Lulus/Tidak Lulus)
- **Tahun Masuk** - Tahun dimulai sekolah
- **Jenis Kelamin** - L/P
- **Kontak WhatsApp** - Tombol untuk hubungi via WhatsApp

### Menu Cepat

- **Informasi Lengkap** - Link ke profil detail
- **Status Kelulusan** - Link ke halaman status kelulusan
- **Ubah Password** - Link untuk mengubah password (implementasi nanti)

### Info Penting

- Cek status kelulusan secara berkala
- Notifikasi akan dikirim via WhatsApp
- Jaga keamanan password
- Hubungi admin jika ada pertanyaan

---

## 6. Profil Siswa

Halaman profil menampilkan semua data siswa yang terdaftar, termasuk:

### Data Identitas

- Nama, NISN, NIS, Jenis Kelamin, NIK, Warga Negara

### Data Pribadi

- Tempat lahir, Tanggal lahir, Agama, Anak ke, Status keluarga

### Data Akademik

- Tahun masuk, Kelas awal, Sekolah asal

### Data Kontak

- Email, No. HP (dengan link WhatsApp)

### Data Alamat

- Alamat lengkap dengan detail RT/RW, Kelurahan, Kecamatan, Kabupaten, Provinsi, Kode Pos

### Data Keluarga

- **Ayah**: Nama, DOB, Pendidikan, Pekerjaan, HP, Alamat
- **Ibu**: Nama, DOB, Pendidikan, Pekerjaan, HP, Alamat
- **Wali** (jika ada): Data yang sama

---

## 7. Status Kelulusan

### Halaman Status

Menampilkan informasi kelulusan siswa dengan:

#### Status Kelulusan

Sistem mendukung 4 status:

1. **🟡 Menunggu Verifikasi** (pending)
    - Status awal setelah registrasi
    - Admin sedang memverifikasi data

2. **🔵 Sudah Dihubungi** (contacted)
    - Admin telah menghubungi siswa via WhatsApp
    - Menunggu klarifikasi/verifikasi lebih lanjut

3. **🟢 Lulus** (verified)
    - Siswa dinyatakan LULUS
    - Dapat mengunduh sertifikat kelulusan
    - Menerima notifikasi sukses via WhatsApp

4. **🔴 Tidak Lulus** (rejected)
    - Siswa TIDAK dinyatakan lulus
    - Hubungi admin untuk informasi lebih lanjut

#### Detail Informasi

- **Nama Siswa** & **NISN**
- **Tahun Masuk** & **Tahun Kelulusan** (otomatis dihitung)
- **Status Saat Ini** - Dengan badge warna
- **Catatan Admin** - Pesan dari admin (jika ada)
- **Nilai Akhir** - Angka nilai (jika sudah diisi admin)
- **Keterangan** - Penjelasan detail

#### Timeline Riwayat

Menampilkan timeline kapan:

- Registrasi awal dilakukan
- Status diperbarui
- Dinyatakan lulus

#### Download Sertifikat

Jika status = **LULUS**, siswa dapat mengunduh sertifikat kelulusan dengan tombol "Download".

#### Info WhatsApp

Menampilkan nomor HP yang terdaftar dan link WhatsApp untuk kontak sekolah.

---

## 8. Notifikasi WhatsApp

### Kapan Notifikasi Dikirim?

Sistem akan mengirim notifikasi WhatsApp ke HP siswa ketika:

1. **Status Berubah Menjadi "Dihubungi"**

    ```
    Halo Ahmad Rifki!
    Admin sekolah akan segera menghubungimu untuk verifikasi data pendaftaran.
    Silakan pastikan nomor HP ini aktif. Terima kasih.
    ```

2. **Status Berubah Menjadi "Lulus"**

    ```
    🎉 Selamat Ahmad Rifki!
    Kamu dinyatakan LULUS!
    Silakan login ke portal siswa untuk download sertifikat kelulusan.
    Sertifikat: https://sekolah.sch.id/student/certificate
    ```

3. **Status Berubah Menjadi "Tidak Lulus"**
    ```
    Pemberitahuan: Ahmad Rifki
    Mohon maaf, kamu belum dinyatakan lulus.
    Silakan hubungi sekolah untuk informasi lebih lanjut.
    Contact: admin@sekolah.sch.id
    ```

### Format Nomor HP

Nomor HP harus dalam format:

- **Dengan kode negara**: +6281234567890
- **Tanpa kode negara**: 081234567890

Sistem akan otomatis konversi ke format yang sesuai untuk WhatsApp API.

---

## 9. Manajemen Status Siswa (Admin)

### Halaman Admin

Admin dapat mengelola status siswa di:

```
/admin/students
```

### Update Status

Admin dapat:

1. **Update Status** - Ubah status dari pending → contacted → verified/rejected
2. **Tulis Catatan** - Tambahkan catatan untuk siswa
3. **Input Nilai** - Isi nilai_akhir dan keterangan
4. **Kirim Notifikasi** - Otomatis terkirim saat status diubah

---

## 10. Tabel Database

### Struktur Tabel `students`

```sql
CREATE TABLE students (
    id_siswa INT PRIMARY KEY AUTO_INCREMENT,

    -- Identitas
    nisn VARCHAR(10) UNIQUE,
    nis VARCHAR(20) UNIQUE,
    nama VARCHAR(100),
    jenis_kelamin CHAR(1), -- L/P
    nik VARCHAR(20),
    warga_negara VARCHAR(50),

    -- Registrasi
    registration_number VARCHAR(50) UNIQUE,
    username VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    uid VARCHAR(36) UNIQUE,

    -- Akademik
    kelas_awal INT,
    tahun_masuk VARCHAR(4),
    sekolah_asal VARCHAR(100),

    -- Pribadi
    tempat_lahir VARCHAR(100),
    tanggal_lahir DATE,
    agama VARCHAR(50),
    hp VARCHAR(20),
    email VARCHAR(100),
    foto VARCHAR(100),

    -- Keluarga
    anak_ke INT,
    status_keluarga CHAR(1),
    alamat LONGTEXT,
    rt VARCHAR(5),
    rw VARCHAR(5),
    kelurahan VARCHAR(100),
    kecamatan VARCHAR(100),
    kabupaten VARCHAR(100),
    provinsi VARCHAR(100),
    kode_pos INT,

    -- Ayah
    nama_ayah VARCHAR(100),
    tgl_lahir_ayah DATE,
    pendidikan_ayah VARCHAR(50),
    pekerjaan_ayah VARCHAR(100),
    nohp_ayah VARCHAR(20),
    alamat_ayah LONGTEXT,

    -- Ibu
    nama_ibu VARCHAR(100),
    tgl_lahir_ibu DATE,
    pendidikan_ibu VARCHAR(50),
    pekerjaan_ibu VARCHAR(100),
    nohp_ibu VARCHAR(20),
    alamat_ibu LONGTEXT,

    -- Wali
    nama_wali VARCHAR(100),
    tgl_lahir_wali DATE,
    pendidikan_wali VARCHAR(50),
    pekerjaan_wali VARCHAR(100),
    nohp_wali VARCHAR(20),
    alamat_wali LONGTEXT,

    -- Status Pendaftaran
    status ENUM('pending', 'contacted', 'verified', 'rejected'),
    admin_note TEXT,

    -- Kelulusan (NEW)
    nilai_akhir DECIMAL(5,2),
    keterangan TEXT,

    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## 11. Routes API

### Student Auth Routes

```
GET  /student-login              → showLoginForm (Student Login)
POST /student-login              → login (Process Login)
GET  /student-register           → showRegisterForm (Student Register Form)
POST /student-register           → register (Process Registration)
```

### Student Protected Routes

```
GET  /student/dashboard          → dashboard (Student Dashboard)
GET  /student/profile            → profile (Student Profile)
GET  /student/graduation-status  → graduationStatus (Graduation Status)
GET  /student/certificate        → downloadCertificate (Download Certificate)
POST /student/logout             → logout (Logout)
```

---

## 12. Controllers

### StudentAuthController

Location: `app/Http/Controllers/StudentAuthController.php`

**Methods:**

- `showLoginForm()` - Tampilkan halaman login siswa
- `login(Request $request)` - Proses login dengan NISN dan password
- `showRegisterForm()` - Tampilkan halaman registrasi
- `register(Request $request)` - Proses registrasi baru dengan validasi lengkap
- `logout()` - Logout siswa

**Validasi Registrasi:**

- Nama: required, string, max 100
- NISN: required, size 10, unique
- NIS: nullable, unique
- Jenis Kelamin: required, in(L,P)
- Tempat Lahir: required, string, max 100
- Tanggal Lahir: required, date, before 2020-01-01
- HP: required, format 08xxxxxxxxxx
- Email: required, email, unique
- Password: required, min 6, confirmed

### StudentController

Location: `app/Http/Controllers/StudentController.php`

**Methods:**

- `dashboard()` - Tampilkan dashboard siswa
- `profile()` - Tampilkan profil lengkap siswa
- `graduationStatus()` - Tampilkan status kelulusan
- `downloadCertificate()` - Download sertifikat (jika lulus)
- `logout()` - Logout siswa

---

## 13. Views

### Student Auth Views

```
resources/views/student/auth/login.blade.php       → Form Login Siswa
resources/views/student/auth/register.blade.php    → Form Registrasi Siswa
```

### Student Portal Views

```
resources/views/student/dashboard.blade.php        → Dashboard Siswa
resources/views/student/profile.blade.php          → Profil Lengkap Siswa
resources/views/student/graduation-status.blade.php → Status Kelulusan
```

---

## 14. Migrations

### Latest Migration

```
database/migrations/2026_03_02_000000_add_graduation_fields_to_students_table.php
```

Menambahkan kolom:

- `nilai_akhir` - Decimal(5,2) untuk nilai akhir
- `keterangan` - TEXT untuk keterangan kelulusan

---

## 15. Authentication Guards

### Dual Guard System

Sistem menggunakan 2 authentication guards:

1. **Guard "web"** (Admin)
    - Model: `App\Models\User`
    - Driver: Session
    - Middleware: `auth` atau `auth:web`

2. **Guard "students"** (Siswa)
    - Model: `App\Models\Student`
    - Driver: Session
    - Middleware: `auth:students`

### Check Authentication

```php
// Check if admin logged in
Auth::check() // or Auth::guard('web')->check()

// Check if student logged in
Auth::guard('students')->check()

// Get current student
Auth::guard('students')->user()
```

---

## 16. Security Features

✅ **Password Hashing** - Semua password di-hash dengan bcrypt
✅ **Unique Fields** - NISN dan Email harus unik
✅ **Session Protection** - Menggunakan Laravel session
✅ **CSRF Protection** - Token CSRF pada semua form
✅ **Route Protection** - Menggunakan middleware auth:students
✅ **Status Validation** - Hanya siswa dengan status "verified" dapat download sertifikat

---

## 17. Fitur yang Akan Datang

- ⏳ **WhatsApp Notification Integration** - Kirim notifikasi otomatis via WhatsApp API
- ⏳ **Password Reset** - Fitur reset password untuk siswa
- ⏳ **Update Profil** - Siswa dapat mengupdate data pribadi
- ⏳ **Certificate PDF Generation** - Generate dan download sertifikat PDF
- ⏳ **Student Grades** - Tampilkan nilai akademik siswa
- ⏳ **Attendance Tracking** - Tracking kehadiran siswa
- ⏳ **Parent Portal** - Portal terpisah untuk orang tua

---

## 18. Tips Penggunaan

### Untuk Siswa

1. **Jaga Password Anda** - Jangan bagikan password ke orang lain
2. **Update Data Tepat Waktu** - Pastikan data kontak selalu aktif
3. **Cek Status Rutin** - Cek status kelulusan secara berkala
4. **Siapkan HP Untuk Notifikasi** - Aktifkan notifikasi WhatsApp

### Untuk Admin

1. **Verify Data** - Verifikasi data siswa sebelum approve
2. **Send Notifications** - Hubungi siswa via WhatsApp saat ada update
3. **Fill Graduation Info** - Isi nilai dan keterangan kelulusan
4. **Keep Notes** - Tulis catatan untuk internal tracking

---

## 19. Troubleshooting

### Error: "NISN tidak ditemukan"

- Pastikan NISN adalah 10 digit
- Periksa apakah NISN sudah terdaftar di sistem
- Hubungi admin untuk verifikasi

### Error: "Password salah"

- Periksa caps lock
- Pastikan password sesuai saat registrasi
- Gunakan fitur reset password (coming soon)

### Notifikasi WhatsApp tidak masuk

- Pastikan nomor HP benar dan aktif
- Cek format: 08xxxxxxxxxx
- Verifikasi nomor di profil
- Hubungi admin untuk resend notifikasi

---

**Pertanyaan atau Masalah?** Hubungi admin sekolah di:

- 📧 Email: admin@sekolah.sch.id
- 📱 WhatsApp: +62-812-3456-7890

---

_Terakhir diupdate: 03 Maret 2026_
