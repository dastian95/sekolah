# Dokumentasi Login Terpusat (Unified Login)

## Daftar Isi

1. [Pengantar](#pengantar)
2. [Fitur Utama](#fitur-utama)
3. [Struktur Teknis](#struktur-teknis)
4. [Panduan Penggunaan](#panduan-penggunaan)
5. [Komponen Carousel](#komponen-carousel)
6. [Testing](#testing)
7. [Troubleshooting](#troubleshooting)

---

## Pengantar

**Login Terpusat (Unified Login)** adalah fitur baru yang menyatukan halaman login untuk siswa dan admin menjadi satu halaman yang elegan dan user-friendly.

### Keuntungan

- ✅ Satu halaman untuk semua pengguna (siswa dan admin)
- ✅ Carousel otomatis menampilkan fitur aplikasi
- ✅ UI modern dengan dua kolom (form + carousel)
- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Toggle mudah antara login siswa dan admin

---

## Fitur Utama

### 1. **Toggle Siswa/Admin**

Dua tombol yang memungkinkan pengguna memilih tipe login:

- **Siswa**: Menggunakan NISN (10 digit) dan password
- **Admin**: Menggunakan Email atau Username dan password

### 2. **Carousel Otomatis**

Carousel berisi 5 slide yang berubah secara otomatis setiap 5 detik:

1. Daftar Mudah - Pendaftaran online tanpa datang ke sekolah
2. Dashboard Personal - Lihat informasi akademik
3. Data Lengkap - Akses data pribadi dan keluarga
4. Status Kelulusan - Cek status dan dapatkan notifikasi WhatsApp
5. Aman & Terpercaya - Teknologi keamanan terkini

### 3. **Form Dinamis**

Form input berubah sesuai dengan tipe login yang dipilih:

- **Untuk Siswa**: Field NISN, Password, Ingat Saya
- **Untuk Admin**: Field Email/Username, Password, Ingat Saya

### 4. **Validasi Otomatis**

- NISN hanya menerima angka (10 digit)
- Email/Username dideteksi otomatis
- Password minimal 6 karakter
- Error message dalam bahasa Indonesia

---

## Struktur Teknis

### Files yang Terlibat

#### 1. **Controller**: `app/Http/Controllers/UnifiedLoginController.php`

```php
- showLoginForm()          : Menampilkan halaman login
- login()                  : Route request ke loginStudent() atau loginAdmin()
- loginStudent()           : Autentikasi siswa dengan NISN
- loginAdmin()             : Autentikasi admin dengan email/username
- logout()                 : Logout untuk semua pengguna
```

**Key Logic:**

```php
// Deteksi tipe login
$userType = $request->input('user_type');

// Validasi berdasarkan tipe
if ($userType === 'student') {
    // NISN validation & Auth::guard('students')->login()
} else {
    // Email/Username validation & Auth::login()
}
```

#### 2. **View**: `resources/views/auth/unified-login.blade.php`

- Layout dua kolom (left: form, right: carousel)
- Carousel dengan Font Awesome icons
- Form dengan toggle dinamis
- Responsive CSS dengan media queries

**Struktur HTML:**

```html
<div class="login-container">
    <div class="login-wrapper">
        <!-- Carousel Section -->
        <div class="carousel-section">
            <div class="carousel-slides">
                <!-- 5 slides -->
            </div>
            <div class="carousel-indicators">
                <!-- Indicator dots -->
            </div>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <!-- Toggle buttons -->
            <!-- Form inputs -->
            <!-- Submit button -->
        </div>
    </div>
</div>
```

#### 3. **Routes**: `routes/web.php`

```php
// Unified Login Routes
Route::middleware('guest')->controller(UnifiedLoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('unified.login');
    Route::post('/login', 'login')->name('unified.login.submit');
});

Route::post('/logout', [UnifiedLoginController::class, 'logout'])->name('unified.logout');
```

#### 4. **Navbar**: `resources/views/layouts/app.blade.php`

Diperbarui untuk menampilkan:

- Single login button "Masuk / Login" ketika tidak login
- Dropdown menu yang sama untuk siswa dan admin ketika login

---

## Panduan Penggunaan

### Untuk Siswa

#### 1. Masuk ke halaman login

```
URL: http://sekolah.local/login
```

#### 2. Pilih toggle "Siswa"

Button akan berwarna biru dan menampilkan field NISN

#### 3. Masukkan data:

```
NISN        : 1234567890 (10 digit)
Password    : password_siswa
```

#### 4. Klik "Login Siswa"

Jika data benar → redirect ke `/student/dashboard`
Jika data salah → tampilkan error "NISN atau password salah"

#### 5. Di dashboard siswa

Dapat mengakses:

- Dashboard dengan 8 kartu informasi cepat
- Profil dengan 47 field data pribadi
- Status kelulusan dan unduh sertifikat
- Logout via dropdown menu

---

### Untuk Admin

#### 1. Masuk ke halaman login

```
URL: http://sekolah.local/login
```

#### 2. Pilih toggle "Admin"

Button akan berwarna orange dan menampilkan field Email/Username

#### 3. Masukkan data:

```
Email/Username  : admin@sekolah.id  atau  admin
Password        : password_admin
```

#### 4. Klik "Login Admin"

Jika data benar → redirect ke `/admin/students`
Jika data salah → tampilkan error "Email/Username atau password salah"

#### 5. Di dashboard admin

Dapat mengakses:

- Daftar siswa
- Impor siswa dari Excel
- Manajemen siswa pindahan
- Logout via dropdown menu

---

## Komponen Carousel

### JavaScript Carousel Logic

#### Auto-Rotation

```javascript
setInterval(nextSlide, 5000); // Berubah setiap 5 detik
```

#### Manual Navigation

```javascript
indicators.forEach((indicator, index) => {
    indicator.addEventListener("click", () => {
        currentSlide = index;
        showSlide(currentSlide);
    });
});
```

#### CSS Animation

```css
.carousel-slide {
    opacity: 0;
    transition: opacity 0.8s ease-in-out;
}

.carousel-slide.active {
    opacity: 1;
}
```

### Customization Carousel

#### Menambah Slide Baru

Edit `resources/views/auth/unified-login.blade.php`:

```html
<!-- Slide 6: Features -->
<div class="carousel-slide" data-slide="5">
    <i
        class="fas fa-star"
        style="font-size: 4rem; color: var(--dark-blue); margin-bottom: 1rem;"
    ></i>
    <h3>Fitur Baru</h3>
    <p>Deskripsi fitur baru</p>
</div>
```

#### Menambah Indicator

```html
<div class="carousel-indicator" data-slide="5"></div>
```

#### Mengubah Interval Auto-Rotation

```javascript
setInterval(nextSlide, 3000); // Berubah setiap 3 detik
```

#### Mengubah Warna Carousel

Ubah di CSS section:

```css
.carousel-section {
    background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
}
```

---

## Testing

### Unit Test Checklist

#### ✅ Login Student

```
Kasus: Login dengan NISN dan password valid
Input:
  - NISN: 1234567890
  - Password: password123
Expected: Redirect ke /student/dashboard
Status: [PASS]
```

#### ✅ Login Admin

```
Kasus: Login dengan email dan password valid
Input:
  - Email: admin@sekolah.id
  - Password: admin123
Expected: Redirect ke /admin/students
Status: [PASS]
```

#### ✅ Invalid NISN

```
Kasus: NISN tidak 10 digit
Input:
  - NISN: 123
  - Password: password
Expected: Form validation error "NISN harus 10 digit"
Status: [PASS]
```

#### ✅ Invalid Password

```
Kasus: Password salah
Input:
  - NISN: 1234567890
  - Password: salah
Expected: Error message "NISN atau password salah"
Status: [PASS]
```

#### ✅ Carousel Auto-Rotation

```
Kasus: Carousel berubah otomatis
Action: Buka halaman login
Expected: Slide berubah setiap 5 detik
Status: [PASS]
```

#### ✅ Manual Carousel Navigation

```
Kasus: Klik indicator dot
Action: Klik indicator ke-3
Expected: Carousel langsung menampilkan slide ke-3
Status: [PASS]
```

#### ✅ Toggle Siswa/Admin

```
Kasus: Switch antara siswa dan admin
Action: Klik toggle "Admin" lalu "Siswa"
Expected: Form fields berganti sesuai tipe
Status: [PASS]
```

#### ✅ Responsive Design

```
Kasus: Akses dari mobile device
Devices: iPhone 12, Samsung Galaxy, iPad
Expected:
  - Carousel hidden (only form shown)
  - Form full width
  - All buttons responsive
Status: [PASS]
```

---

## Troubleshooting

### Issue 1: "NISN atau password salah" padahal data benar

**Penyebab:**

- NISN tidak ditemukan di database
- Password tidak di-hash dengan benar
- Guard 'students' tidak konfigurasi

**Solusi:**

```bash
# Cek data di database
SELECT nisn, password FROM students WHERE nisn = '1234567890';

# Verify password hashing
php artisan tinker
>>> \App\Models\Student::find(1)->password
```

---

### Issue 2: Carousel tidak bergerak otomatis

**Penyebab:**

- JavaScript tidak dimuat
- CSS display:none menganggu
- Z-index conflict

**Solusi:**

```javascript
// Debug di browser console
console.log("Current slide:", currentSlide);
console.log("Total slides:", totalSlides);

// Cek interval
setInterval(() => {
    console.log("Carousel tick");
    nextSlide();
}, 5000);
```

---

### Issue 3: Login button tidak muncul di navbar

**Penyebab:**

- Route name error (unified.login vs login)
- Auth middleware tidak bekerja
- Cache stale

**Solusi:**

```bash
# Clear cache
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Check routes
php artisan route:list | grep login
```

---

### Issue 4: Form tidak submit

**Penyebab:**

- CSRF token hilang
- JavaScript validation gagal
- Form action wrong

**Solusi:**

```html
<!-- Pastikan @csrf ada -->
<form method="POST" id="loginForm" action="{{ route('unified.login.submit') }}">
    @csrf ...
</form>

<!-- Check browser console untuk error -->
document.getElementById('loginForm').addEventListener('submit', (e) => {
console.log('Form submit triggered'); });
```

---

### Issue 5: Redirect loop

**Penyebab:**

- Middleware 'guest' tidak bekerja
- Route redirect salah
- Session config error

**Solusi:**

```php
// Periksa routes/web.php
Route::middleware('guest')->group(function () {
    Route::get('/login', ...)->name('unified.login');
});

// Cek config/auth.php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'students' => [
        'driver' => 'session',
        'provider' => 'students',
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
    'students' => [
        'driver' => 'eloquent',
        'model' => App\Models\Student::class,
    ],
],
```

---

## Fitur Lanjutan

### Remember Me

Jika checkbox "Ingat saya" dicentang, session diperpanjang 1 tahun:

```php
Auth::guard('students')->login($student, $request->filled('remember'));
```

### Password Forgot

Link "Lupa password?" dapat dihubungkan dengan:

```php
Route::get('/password-reset', [PasswordResetController::class, 'form'])->name('password.request');
```

### WhatsApp Integration

Setelah login, kirim notifikasi WhatsApp:

```php
\Notifications\WhatsAppNotification::send(
    $student->no_telepon_orangtua,
    "Anda berhasil login ke portal siswa SDIT Labitech"
);
```

---

## Kesimpulan

Login Terpusat memberikan pengalaman pengguna yang lebih baik dengan:

- ✅ Satu halaman untuk semua user type
- ✅ Carousel interaktif yang menarik
- ✅ Form dinamis dan responsive
- ✅ Validasi user-friendly
- ✅ Logout terpusat dengan guard detection

Untuk pertanyaan atau issue, hubungi tim teknis SDIT Labitech Insan Mulia.

---

**Terakhir diperbarui**: 21 Februari 2026
**Versi**: 1.0
**Status**: Production Ready ✅
