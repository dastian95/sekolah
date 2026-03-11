# Dokumentasi Fitur Pendaftaran & Pendaftaran Pindahan

## Ringkasan

Fitur ini menambahkan dua jenis pendaftaran untuk sistem SDIT Labitech Insan Mulia:

1. **Pendaftaran Siswa Baru** - Untuk calon siswa baru dari TK/RA
2. **Pendaftaran Siswa Pindahan** - Untuk siswa yang ingin pindah dari sekolah lain

---

## 📁 File-File yang Ditambahkan

### 1. Database Migrations

- **`database/migrations/2026_03_01_000000_create_transfer_students_table.php`**
    - Membuat tabel `transfer_students` untuk menyimpan data siswa pindahan
    - Field utama: transfer_number, full_name, previous_school, current_class, reason_transfer, dokumen-dokumen

### 2. Models

- **`app/Models/TransferStudent.php`**
    - Model Eloquent untuk tabel transfer_students
    - Helper method untuk status badge dan label
    - Fillable attributes untuk mass assignment

### 3. Controllers

- **`app/Http/Controllers/PendaftaranPindahanController.php`**
    - `create()` - Menampilkan form pendaftaran pindahan
    - `store()` - Menyimpan data dan file uploads
    - Auto-generate transfer number (TRANS-YYYY-XXX)

- **`app/Http/Controllers/AdminTransferStudentController.php`**
    - `index()` - Daftar siswa pindahan dengan filter & search
    - `show()` - Detail pendaftaran siswa pindahan
    - `updateStatus()` - Ubah status pendaftaran

### 4. Views

#### Frontend

- **`resources/views/pendaftaran-pindahan.blade.php`**
    - Form pendaftaran siswa pindahan yang lengkap
    - Input file untuk rapor dan surat pindah
    - Validasi client-side dan error messages

#### Admin Dashboard

- **`resources/views/admin/students/index.blade.php`**
    - Daftar siswa baru dengan filter status & search
    - Tab navigation ke siswa pindahan
    - Quick status update dropdown

- **`resources/views/admin/transfer-students/index.blade.php`**
    - Daftar siswa pindahan dengan filter
    - Informasi sekolah asal dan kelas
    - Link ke detail view

- **`resources/views/admin/transfer-students/show.blade.php`**
    - Detail lengkap siswa pindahan
    - Tampilan dokumen (rapor & surat pindah)
    - Form update status dengan catatan admin
    - Timeline pendaftaran

### 5. Routes

**`routes/web.php`** - Ditambahkan:

```php
// Pendaftaran Pindahan page
Route::get('/pendaftaran-pindahan', [PendaftaranPindahanController::class, 'create'])
    ->name('pendaftaran-pindahan');
Route::post('/pendaftaran-pindahan', [PendaftaranPindahanController::class, 'store'])
    ->name('pendaftaran-pindahan.store');

// Admin Routes
Route::get('/admin/transfer-students', [AdminTransferStudentController::class, 'index'])
    ->name('admin.transfer-students.index');
Route::get('/admin/transfer-students/{transferStudent}', [AdminTransferStudentController::class, 'show'])
    ->name('admin.transfer-students.show');
Route::patch('/admin/transfer-students/{transferStudent}/status', [AdminTransferStudentController::class, 'updateStatus'])
    ->name('admin.transfer-students.updateStatus');
```

### 6. Layout Updates

**`resources/views/layouts/app.blade.php`** - Diubah:

- Navbar menu "Pendaftaran" menjadi dropdown dengan 2 opsi:
    - Siswa Baru
    - Siswa Pindahan
- Update script active nav link untuk handle dropdown

---

## 🔄 Alur Kerja

### Untuk Calon Siswa:

1. **Pendaftaran Siswa Baru** (`/pendaftaran`)
    - Isi form dengan data siswa, orang tua
    - Submit form → auto-generate no. registrasi `REG-YYYY-XXX`
    - Terima konfirmasi via WhatsApp

2. **Pendaftaran Siswa Pindahan** (`/pendaftaran-pindahan`)
    - Isi form dengan data siswa, sekolah asal, alasan pindah
    - Upload dokumen (rapor & surat pindah - opsional)
    - Submit form → auto-generate no. registrasi `TRANS-YYYY-XXX`
    - Terima konfirmasi via WhatsApp

### Untuk Admin:

1. **Lihat Daftar Pendaftaran**
    - Siswa Baru: `/admin/students`
    - Siswa Pindahan: `/admin/transfer-students`

2. **Filter & Search**
    - Cari berdasarkan nama atau no. registrasi
    - Filter berdasarkan status (pending, contacted, verified, rejected)

3. **Kelola Status**
    - Update status via dropdown di list view
    - Lihat detail lengkap di show view
    - Tambah catatan admin
    - Download dokumen (untuk siswa pindahan)

---

## 📊 Status Pendaftaran

| Status      | Warna Badge      | Keterangan                       |
| ----------- | ---------------- | -------------------------------- |
| `pending`   | warning (kuning) | Baru daftar, menunggu konfirmasi |
| `contacted` | info (biru)      | Sudah dihubungi via WhatsApp     |
| `verified`  | success (hijau)  | Data valid, diterima             |
| `rejected`  | danger (merah)   | Ditolak/tidak diterima           |

---

## 🔐 Data & Keamanan

### Form Validasi (Server-side)

```php
// Siswa Baru
- full_name: required, string, max 255
- gender: required, in:L,P
- birth_place: required, string
- birth_date: required, date
- origin_school: nullable, string
- parent_name: required, string
- whatsapp_number: required, string, max 20
- address_short: nullable, string

// Siswa Pindahan (tambahan)
- previous_school: required, string
- current_class: required, string
- reason_transfer: required, string, max 1000
- report_card_file: nullable, file, mimes:pdf,jpg,jpeg,png, max:5120 (5MB)
- transfer_letter_file: nullable, file, mimes:pdf,jpg,jpeg,png, max:5120 (5MB)
```

### File Upload

- Dokumen tersimpan di folder: `storage/app/public/transfer-documents/`
- Akses via: `asset('storage/transfer-documents/...')`
- Maksimal ukuran: 5MB per file
- Format: PDF, JPG, JPEG, PNG

---

## 📝 Catatan Implementasi

### Auto-Generated Numbers

- **Siswa Baru**: `REG-2026-001`, `REG-2026-002`, dst
- **Siswa Pindahan**: `TRANS-2026-001`, `TRANS-2026-002`, dst
- Reset per tahun

### WhatsApp Integration

- Link WhatsApp format: `https://wa.me/{nomor_tanpa_format}`
- Contoh: `https://wa.me/6281234567890`
- Admin dapat langsung hubungi orang tua dari dashboard

### Multi-file Upload

- Dropzone atau native file input
- Support multiple format dokumen
- Validasi size & format server-side

---

## 🚀 Cara Menggunakan

### 1. Jalankan Migration

```bash
php artisan migrate
```

### 2. Aksesibilitas

#### User/Calon Siswa:

- Pendaftaran Siswa Baru: `http://sekolah.local/pendaftaran`
- Pendaftaran Pindahan: `http://sekolah.local/pendaftaran-pindahan`

#### Admin (Login Required):

- Dashboard Siswa Baru: `http://sekolah.local/admin/students`
- Dashboard Siswa Pindahan: `http://sekolah.local/admin/transfer-students`
- Detail Siswa Pindahan: `http://sekolah.local/admin/transfer-students/{id}`

---

## 🔮 Fitur yang Bisa Dikembangkan ke Depan

1. **Export Data** - Export pendaftaran ke Excel/PDF
2. **Email Notification** - Kirim email otomatis saat status berubah
3. **Form Progress Tracker** - Tampilkan progress pendaftaran ke calon siswa
4. **Document Templates** - Template surat penerimaan/penolakan
5. **Integration dengan Sistem Nilai** - Auto-sync nilai dari rapor (OCR)
6. **Payment Gateway** - Biaya pendaftaran/registrasi online
7. **Bulk Import** - Import data dari file Excel
8. **API Integration** - Expose data via API untuk aplikasi mobile

---

## 📞 Support

Untuk pertanyaan atau bantuan implementasi fitur ini, silakan hubungi tim pengembang.

**Last Updated**: 1 Maret 2026
