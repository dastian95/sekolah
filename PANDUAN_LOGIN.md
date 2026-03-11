# Panduan Login Administrator

## Informasi Login Default

Sistem telah dibuat dengan beberapa akun admin default yang bisa langsung digunakan untuk testing:

### Akun Admin Tersedia:

#### 1. Admin Utama

- **Username/Email**: `labitech` atau `admin@labitech.sch.id`
- **Password**: `secret123`
- **Role**: Administrator Utama

#### 2. Kepala Sekolah

- **Username**: `kepalasekolah`
- **Email**: `kepsek@labitech.sch.id`
- **Password**: `labitech2026`
- **Role**: Kepala Sekolah

#### 3. Tata Usaha

- **Username**: `tatausaha`
- **Email**: `tu@labitech.sch.id`
- **Password**: `admin12345`
- **Role**: Tata Usaha

---

## Cara Login

### Langkah 1: Buka Halaman Login

```
URL: http://localhost/sekolah/login
atau
URL: https://sekolah.local/login
```

### Langkah 2: Masukkan Kredensial

- Masukkan **Username ATAU Email** (pilih salah satu)
- Masukkan **Password**
- Centang "Ingat Saya" jika ingin tetap login

### Langkah 3: Klik MASUK

- Jika berhasil, akan diarahkan ke Dashboard Admin
- Jika gagal, akan muncul pesan error

---

## Fitur Login

✅ **Dual Login Support**

- Bisa login menggunakan **username** (contoh: `labitech`)
- Atau bisa login menggunakan **email** (contoh: `admin@labitech.sch.id`)

✅ **Password Validation**

- Password minimal 6 karakter
- Password dienkripsi menggunakan bcrypt

✅ **Remember Me**

- Centang "Ingat Saya" untuk tetap login
- Browser akan menyimpan session dalam cookie

✅ **Error Handling**

- Pesan error yang jelas jika login gagal
- Validasi input untuk keamanan

✅ **Session Security**

- Session otomatis di-regenerate setelah login
- CSRF protection aktif

---

## Troubleshooting

### Error: "Username/Email atau Password tidak sesuai"

**Solusi:**

1. Pastikan username/email benar (besar-kecil huruf tidak berpengaruh)
2. Pastikan password benar (besar-kecil huruf BERPENGARUH)
3. Cek apakah Caps Lock aktif
4. Reset password jika lupa

### Error: "Username atau Email harus diisi"

**Solusi:**

- Input field tidak boleh kosong
- Masukkan username atau email yang valid

### Error: "Password harus diisi"

**Solusi:**

- Input password tidak boleh kosong
- Password minimal 6 karakter

### Tidak Bisa Login Padahal Username & Password Benar?

**Kemungkinan:**

1. Username/Email belum terdaftar di database
2. Password belum di-hash dengan bcrypt
3. Browser cache yang lama

**Solusi:**

1. Periksa tabel `users` di database
2. Jalankan ulang AdminSeeder: `php artisan db:seed --class=AdminSeeder`
3. Clear browser cache
4. Coba mode Private/Incognito

---

## Reset Password

### Untuk Admin Development:

Jika lupa password, Anda bisa membuat akun baru atau reset lewat tinker:

```bash
php artisan tinker

# Cari user
$user = App\Models\User::where('name', 'labitech')->first();

# Set password baru
$user->password = bcrypt('password_baru');
$user->save();

# Exit
exit
```

### Via Dashboard (Jika Ada Fitur Edit User):

1. Login dengan akun admin yang masih ingat password
2. Buka menu Kelola Users
3. Pilih user yang ingin direset passwordnya
4. Klik Reset Password atau Edit
5. Masukkan password baru

---

## Keamanan Login

🔒 **Best Practices:**

1. **Jangan** bagikan username/password
2. **Ubah** password default setelah first login
3. **Gunakan** password yang kuat (kombinasi huruf, angka, simbol)
4. **Logout** setelah selesai (terutama di komputer bersama)
5. **Jangan** centang "Ingat Saya" di komputer publik

---

## Logout

### Cara Logout:

1. Klik icon profil di navbar (setelah login)
2. Pilih "Logout"
3. Akan diarahkan ke homepage dengan pesan "Anda telah logout"

---

## Struktur Login System

### Controller: `AuthController.php`

- `showLoginForm()` - Tampilkan form login
- `login()` - Process login request
    - Validasi input
    - Cek user di database (email atau name)
    - Hash password comparison
    - Session management
- `logout()` - Process logout request

### Model: `User.php`

- Extends `Authenticatable`
- Fields: id, name, email, password, remember_token

### View: `auth/login.blade.php`

- Form login dengan design responsif
- Error handling & validation messages
- Support untuk "Remember Me"

### Routes:

- `GET /login` → `showLoginForm()`
- `POST /login` → `login()` (name: `login.submit`)
- `POST /logout` → `logout()` (name: `logout`)

---

## Testing Login

### Test Case 1: Login Berhasil

```
Username: labitech
Password: secret123
Expected: Diarahkan ke /admin/students
```

### Test Case 2: Login dengan Email

```
Email: admin@labitech.sch.id
Password: secret123
Expected: Diarahkan ke /admin/students
```

### Test Case 3: Password Salah

```
Username: labitech
Password: salah123
Expected: Error message "Username/Email atau Password tidak sesuai"
```

### Test Case 4: Username Tidak Ada

```
Username: tidakadasipun
Password: secret123
Expected: Error message "Username/Email atau Password tidak sesuai"
```

### Test Case 5: Field Kosong

```
Username: (kosong)
Password: secret123
Expected: Error message "Username atau Email harus diisi"
```

---

## FAQ

**Q: Bisakah login menggunakan nomor induk siswa?**
A: Saat ini tidak. Login hanya support username (name field) atau email. Untuk student portal, bisa dikembangkan terpisah.

**Q: Apakah ada timeout untuk session?**
A: Ya, sesuai konfigurasi Laravel di `config/session.php` (default 120 menit).

**Q: Bisakah multiple login dari device berbeda?**
A: Ya, setiap device akan memiliki session sendiri.

**Q: Bagaimana jika akun di-hack?**
A: Reset password admin account melalui tinker atau buat user baru yang valid.

**Q: Apakah semua error message sama?**
A: Ya, untuk security, error message "Username/Email atau Password tidak sesuai" tidak membedakan apakah username/email tidak ada atau password salah.

---

## Kesimpulan

Login system sudah siap digunakan dengan:

- ✅ Dual authentication (username/email)
- ✅ Secure password hashing
- ✅ Session management
- ✅ CSRF protection
- ✅ Error handling
- ✅ Remember Me functionality

Silakan test login dengan akun admin yang sudah disediakan!
