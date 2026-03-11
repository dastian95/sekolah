# Dokumentasi Import Data Siswa dari Excel

## Ringkasan

Sistem sekarang mendukung import data siswa dari file Excel dengan struktur yang sesuai dengan master_siswa. Data yang di-import akan disimpan ke tabel `students` dengan semua field yang lengkap.

## Struktur Database `students`

Tabel `students` memiliki field-field berikut:

### A. Identitas Siswa

| Field           | Tipe         | Keterangan                                  |
| --------------- | ------------ | ------------------------------------------- |
| `id_siswa`      | Integer (PK) | ID unik siswa (auto-increment)              |
| `nisn`          | String       | Nomor Induk Siswa Nasional (10 digit, unik) |
| `nis`           | String       | Nomor Induk Sekolah (unik)                  |
| `nama`          | String       | Nama lengkap siswa                          |
| `jenis_kelamin` | Char(1)      | L (Laki-laki) atau P (Perempuan)            |
| `nik`           | String       | Nomor Identitas Keluarga                    |
| `warga_negara`  | String       | Kewarganegaraan (default: Indonesia)        |

### B. Registrasi & Authentication

| Field                 | Tipe   | Keterangan                                       |
| --------------------- | ------ | ------------------------------------------------ |
| `registration_number` | String | No. registrasi pendaftaran (misal: REG-2026-001) |
| `username`            | String | Username untuk login (unik)                      |
| `password`            | String | Password (di-hash dengan bcrypt)                 |
| `uid`                 | String | Unique Identifier (UUID)                         |

### C. Data Akademik

| Field          | Tipe    | Keterangan               |
| -------------- | ------- | ------------------------ |
| `kelas_awal`   | Integer | Kelas saat masuk sekolah |
| `tahun_masuk`  | String  | Tahun masuk ke sekolah   |
| `sekolah_asal` | String  | Sekolah/TK asal siswa    |

### D. Data Pribadi

| Field           | Tipe   | Keterangan                          |
| --------------- | ------ | ----------------------------------- |
| `tempat_lahir`  | String | Tempat lahir                        |
| `tanggal_lahir` | Date   | Tanggal lahir (format: YYYY-MM-DD)  |
| `agama`         | String | Agama siswa                         |
| `hp`            | String | Nomor HP siswa                      |
| `email`         | String | Email siswa                         |
| `foto`          | String | Nama file foto (default: siswa.png) |

### E. Data Keluarga & Alamat

| Field             | Tipe    | Keterangan                             |
| ----------------- | ------- | -------------------------------------- |
| `anak_ke`         | Integer | Urutan anak dalam keluarga             |
| `status_keluarga` | Char(1) | A (Anak Kandung), T (Tiri), C (Angkat) |
| `alamat`          | Text    | Alamat lengkap                         |
| `rt`              | String  | Nomor RT                               |
| `rw`              | String  | Nomor RW                               |
| `kelurahan`       | String  | Kelurahan/Desa                         |
| `kecamatan`       | String  | Kecamatan                              |
| `kabupaten`       | String  | Kabupaten/Kota                         |
| `provinsi`        | String  | Provinsi                               |
| `kode_pos`        | Integer | Kode Pos                               |

### F. Data Ayah

| Field             | Tipe   | Keterangan               |
| ----------------- | ------ | ------------------------ |
| `nama_ayah`       | String | Nama lengkap ayah        |
| `tgl_lahir_ayah`  | Date   | Tanggal lahir ayah       |
| `pendidikan_ayah` | String | Pendidikan terakhir ayah |
| `pekerjaan_ayah`  | String | Pekerjaan ayah           |
| `nohp_ayah`       | String | No. HP ayah              |
| `alamat_ayah`     | Text   | Alamat ayah              |

### G. Data Ibu

| Field            | Tipe   | Keterangan              |
| ---------------- | ------ | ----------------------- |
| `nama_ibu`       | String | Nama lengkap ibu        |
| `tgl_lahir_ibu`  | Date   | Tanggal lahir ibu       |
| `pendidikan_ibu` | String | Pendidikan terakhir ibu |
| `pekerjaan_ibu`  | String | Pekerjaan ibu           |
| `nohp_ibu`       | String | No. HP ibu              |
| `alamat_ibu`     | Text   | Alamat ibu              |

### H. Data Wali (Jika Ada)

| Field             | Tipe   | Keterangan               |
| ----------------- | ------ | ------------------------ |
| `nama_wali`       | String | Nama lengkap wali        |
| `tgl_lahir_wali`  | Date   | Tanggal lahir wali       |
| `pendidikan_wali` | String | Pendidikan terakhir wali |
| `pekerjaan_wali`  | String | Pekerjaan wali           |
| `nohp_wali`       | String | No. HP wali              |
| `alamat_wali`     | Text   | Alamat wali              |

### I. Status & Catatan

| Field        | Tipe | Keterangan                             |
| ------------ | ---- | -------------------------------------- |
| `status`     | Enum | pending, contacted, verified, rejected |
| `admin_note` | Text | Catatan admin                          |

---

## Format Kolom Excel

Ketika membuat file Excel untuk import, gunakan struktur kolom berikut dalam urutan yang **TEPAT**:

### Urutan Kolom Excel (A1-AS1):

```
A: NISN
B: NIS
C: Nama
D: Jenis Kelamin
E: Username
F: Password
G: Kelas Awal
H: Tahun Masuk
I: Sekolah Asal
J: Tempat Lahir
K: Tanggal Lahir
L: Agama
M: HP
N: Email
O: Foto
P: Anak Ke
Q: Status Keluarga
R: Alamat
S: RT
T: RW
U: Kelurahan
V: Kecamatan
W: Kabupaten
X: Provinsi
Y: Kode Pos
Z: Nama Ayah
AA: Tgl Lahir Ayah
AB: Pendidikan Ayah
AC: Pekerjaan Ayah
AD: NoHP Ayah
AE: Alamat Ayah
AF: Nama Ibu
AG: Tgl Lahir Ibu
AH: Pendidikan Ibu
AI: Pekerjaan Ibu
AJ: NoHP Ibu
AK: Alamat Ibu
AL: Nama Wali
AM: Tgl Lahir Wali
AN: Pendidikan Wali
AO: Pekerjaan Wali
AP: NoHP Wali
AQ: Alamat Wali
AR: NIK
AS: Warga Negara
```

---

## Contoh Data Excel

Baris pertama (Header):

```
NISN | NIS | Nama | Jenis Kelamin | Username | Password | ... dst
```

Baris data (dimulai dari baris 2):

```
0012345678 | 001 | Ahmad Fauzi Rahman | L | ahmad123 | password123 | 1 | 2026 | TK Az-Zahra | Jakarta | 01/01/2015 | Islam | 081234567890 | ahmad@email.com | siswa.png | 1 | A | Jl. Merdeka No. 123 | 01 | 02 | Jakarta Pusat | Jakarta Pusat | Jakarta | DKI Jakarta | 12345 | Budi Rahman | 05/05/1975 | S1 | Karyawan Swasta | 081234567890 | ... dst
```

---

## Cara Menggunakan Fitur Import

### 1. Download Template Excel

- Buka: `/admin/students/import/form`
- Klik tombol "Download Template Excel"
- Template akan otomatis download dengan header yang sudah benar

### 2. Isi Data di Excel

- Jangan mengubah nama/urutan kolom
- Baris pertama adalah header (tidak di-import)
- Mulai isi data dari baris ke-2
- Kosongkan cell jika data tidak ada (akan jadi NULL)

### 3. Format Data

- **NISN**: 10 digit angka (misal: `0012345678`)
- **NIS**: String alphanumeric (misal: `001`)
- **Tanggal**: DD/MM/YYYY (misal: `15/03/2015`)
- **Jenis Kelamin**: `L` atau `P`
- **Username**: Hanya huruf, angka, underscore (no spasi)
- **Password**: Akan di-encrypt, jika kosong default `12345678`

### 4. Upload File

- Buka: `/admin/students/import/form`
- Pilih file Excel (.xlsx, .xls, atau .csv)
- Klik "Upload & Import Data"
- Tunggu proses selesai

### 5. Verifikasi Hasil

- Cek halaman `/admin/students` untuk melihat data yang sudah di-import
- Data akan langsung mendapat status `verified`
- Jika ada error, akan ditampilkan daftar error yang perlu diperbaiki

---

## Validasi & Error Handling

### Field Wajib Diisi:

- `NISN` - Harus unik (tidak boleh duplikat)
- `NIS` - Harus unik (tidak boleh duplikat)
- `Nama` - Tidak boleh kosong

### Field Opsional (Boleh Kosong):

- Semua field lainnya boleh kosong dan akan disimpan sebagai NULL

### Error yang Mungkin Terjadi:

1. **Duplikat NISN**: Jika NISN sudah ada di database
2. **Duplikat NIS**: Jika NIS sudah ada di database
3. **Format Tanggal Salah**: Harus DD/MM/YYYY
4. **Data Tidak Lengkap**: Jika row tidak memiliki nilai penting

---

## Tips Penting

✅ **LAKUKAN:**

- Gunakan template yang disediakan sebagai acuan
- Periksa kembali data sebelum upload
- Backup file Excel sebelum import
- Pastikan NISN dan NIS unik
- Gunakan format tanggal yang konsisten

❌ **JANGAN:**

- Mengubah urutan kolom
- Menghapus kolom header
- Mengisi karakter khusus di field NISN/NIS
- Duplikat data sebelum upload
- Upload file yang sudah di-modify strukturnya

---

## FAQ

**Q: Bagaimana jika saya salah upload data?**
A: Anda bisa menghapus data secara manual di dashboard admin, lalu upload lagi dengan data yang benar.

**Q: Apakah password akan terlihat di dashboard?**
A: Tidak, password disimpan terenkripsi dengan bcrypt. Admin hanya bisa reset password, bukan melihatnya.

**Q: Bisakah saya update data yang sudah ada?**
A: Saat ini tidak. Import hanya untuk data baru. Jika perlu update, edit langsung di database atau buat fitur edit.

**Q: Berapa limit jumlah data yang bisa di-import?**
A: Teoritis unlimited, tapi disarankan max 1000 baris per file untuk performa optimal.

**Q: Bagaimana jika username kosong saat import?**
A: Username akan di-generate otomatis dari nama siswa (misal: "Ahmad Fauzi" → "ahmadfauzi")

---

## Export Dari Format Lama ke Format Baru

Jika Anda memiliki data dari sistem lama (format `master_siswa.sql`), Anda bisa:

1. **Export ke CSV/Excel**: Dari database lama, export dengan kolom sesuai urutan di atas
2. **Mapping Field**: Pastikan setiap kolom Excel sesuai dengan field di tabel students
3. **Validasi Duplikat**: Periksa tidak ada NISN/NIS yang duplikat
4. **Upload**: Gunakan fitur import untuk memasukkan ke database baru

---

## Kesimpulan

Dengan fitur import ini, Anda dapat:
✅ Mengisi data siswa secara bulk dari Excel
✅ Migrasi data dari sistem lama tanpa menulis ulang
✅ Menjaga konsistensi data dengan validasi otomatis
✅ Menghemat waktu data entry manual
