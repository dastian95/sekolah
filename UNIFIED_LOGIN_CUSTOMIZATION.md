# 🎨 Unified Login - Customization Guide

## Table of Contents

1. [Color Customization](#color-customization)
2. [Carousel Customization](#carousel-customization)
3. [Form Fields Customization](#form-fields-customization)
4. [Text & Messages](#text--messages)
5. [Styling & Layout](#styling--layout)
6. [Advanced Customization](#advanced-customization)

---

## Color Customization

### Root CSS Variables

Edit in `resources/views/auth/unified-login.blade.php` (search for `:root`):

```css
:root {
    --primary-blue: #0066cc; /* Form buttons, input focus */
    --secondary-yellow: #ffd700; /* Carousel background */
    --dark-blue: #1a3a5c; /* Navbar, heading */
    --light-gray: #f8f9fa; /* Background */
}
```

### Change Primary Blue (Student Login)

```css
:root {
    --primary-blue: #007bff; /* Lighter blue */
    /* OR */
    --primary-blue: #0052a3; /* Darker blue */
    /* OR */
    --primary-blue: #4287f5; /* Purple-ish blue */
}
```

### Change Carousel Background

```css
.carousel-section {
    background: linear-gradient(135deg, #ff9800 0%, #ffb74d 100%);
    /* Orange gradient */
    /* OR */
    background: linear-gradient(135deg, #2196f3 0%, #21cbf3 100%);
    /* Cyan gradient */
    /* OR */
    background: linear-gradient(135deg, #66bb6a 0%, #81c784 100%);
    /* Green gradient */
}
```

### Change Admin Button Color

Find `.toggle-btn.admin.active` in CSS:

```css
.toggle-btn.admin.active {
    background: linear-gradient(135deg, #ff5722 0%, #ff8a65 100%);
    border-color: #ff5722;
    box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
}
```

### Change Navbar Color

Edit in `resources/views/layouts/app.blade.php`:

```css
.navbar-custom {
    background-color: #2c3e50; /* Dark gray */
    /* OR */
    background-color: #34495e; /* Slate */
    /* OR */
    background-color: #1a1a2e; /* Deep dark */
}
```

---

## Carousel Customization

### Change Auto-Rotation Speed

Edit line ~370:

```javascript
// Current: 5 seconds
setInterval(nextSlide, 5000);

// Change to:
setInterval(nextSlide, 3000); // 3 seconds (faster)
setInterval(nextSlide, 7000); // 7 seconds (slower)
setInterval(nextSlide, 10000); // 10 seconds (very slow)
```

### Add New Carousel Slide

1. Add HTML slide in carousel-slides div:

```html
<!-- After Slide 5, before closing carousel-slides div -->

<!-- Slide 6: Performance -->
<div class="carousel-slide" data-slide="5">
    <i
        class="fas fa-tachometer-alt"
        style="font-size: 4rem; color: var(--dark-blue); margin-bottom: 1rem;"
    ></i>
    <h3>Performa Cepat</h3>
    <p>Aplikasi yang responsif dan cepat diakses</p>
</div>
```

2. Add indicator for new slide:

```html
<!-- After indicator 4 -->
<div class="carousel-indicator" data-slide="5"></div>
```

3. Update JavaScript totalSlides (if needed - auto-detects)

### Remove Carousel Slide

1. Delete the slide HTML block
2. Delete corresponding indicator
3. Update data-slide numbers in subsequent slides

Example: Remove Slide 3 (Data Lengkap):

```html
<!-- DELETE this -->
<div class="carousel-slide" data-slide="2">
    <i class="fas fa-address-card" ...></i>
    <h3>Data Lengkap</h3>
    <p>Akses semua data pribadi dan keluarga Anda dengan aman</p>
</div>

<!-- DELETE this -->
<div class="carousel-indicator" data-slide="2"></div>

<!-- UPDATE remaining slides' data-slide numbers -->
<!-- Slide 4 becomes data-slide="2" -->
<!-- Slide 5 becomes data-slide="3" -->
```

### Replace Carousel Content with Images

Instead of Font Awesome icons, use images:

```html
<!-- Original (icons) -->
<div class="carousel-slide active" data-slide="0">
    <i class="fas fa-user-plus" style="font-size: 4rem; ...></i>
    <h3>Daftar Mudah</h3>
    <p>Siswa baru dapat mendaftar sendiri...</p>
</div>

<!-- Modified (with image) -->
<div class="carousel-slide active" data-slide="0">
    <img src="{{ asset('images/carousel/daftar.jpg') }}" alt="Daftar Mudah">
    <h3>Daftar Mudah</h3>
    <p>Siswa baru dapat mendaftar sendiri...</p>
</div>
```

### Customize Carousel Slide Text

Simply edit the `<h3>` and `<p>` content:

```html
<!-- Change from: -->
<h3>Daftar Mudah</h3>
<p>Siswa baru dapat mendaftar sendiri tanpa perlu datang ke sekolah</p>

<!-- To: -->
<h3>Pendaftaran Online</h3>
<p>Proses pendaftaran cepat dan mudah tanpa antri</p>
```

### Change Carousel Background Gradient

```css
.carousel-section {
    /* From Yellow gradient: */
    background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);

    /* To custom gradient: */
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

    /* Or single color: */
    background: #f5f5f5;

    /* Or image: */
    background: url('{{ asset("images/carousel-bg.jpg") }}');
    background-size: cover;
}
```

---

## Form Fields Customization

### Change Input Placeholder Text

```html
<!-- Student NISN input -->
<input
    type="text"
    id="nisn"
    name="nisn"
    placeholder="10 digit NISN (misal: 1234567890)"
    <!-- Change to: -->
    placeholder="Masukkan NISN 10 digit"
>

<!-- Admin Email input -->
<input
    type="text"
    id="email"
    name="email"
    placeholder="Email atau username admin"
    <!-- Change to: -->
    placeholder="Email atau Username"
>
```

### Change Password Requirements

Edit validation in `UnifiedLoginController.php`:

```php
// Student password validation
$request->validate([
    'password' => 'required|string|min:6',  // 6 characters
    // Change to:
    'password' => 'required|string|min:8',  // 8 characters
    // OR
    'password' => 'required|string|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',
    // OR (with error message)
    'password' => 'required|string|confirmed',
]);
```

### Add New Form Field

Example: Add "Remember for 30 days" option:

```html
<!-- Instead of: -->
<div class="form-options">
    <label class="remember-me">
        <input type="checkbox" name="remember" id="remember" />
        <span>Ingat saya</span>
    </label>
    <a href="#" class="forgot-password">Lupa password?</a>
</div>

<!-- Change to: -->
<div class="form-options">
    <label class="remember-me">
        <input type="checkbox" name="remember" id="remember" />
        <span>Ingat saya selama 30 hari</span>
    </label>
    <a href="#" class="forgot-password">Lupa password?</a>
</div>
```

### Make Fields Optional

Edit controller validation:

```php
// From:
$request->validate([
    'nisn' => 'required|string|size:10',
]);

// To:
$request->validate([
    'nisn' => 'nullable|string|size:10',  // Optional now
]);
```

---

## Text & Messages

### Change Form Header Text

Edit in `unified-login.blade.php`:

```html
<!-- From: -->
<div class="form-header">
    <h2>Masuk</h2>
    <p>Pilih tipe akun dan login</p>
</div>

<!-- To: -->
<div class="form-header">
    <h2>Portal Siswa SDIT Labitech</h2>
    <p>Silakan login dengan akun Anda</p>
</div>
```

### Change Button Text

```html
<!-- Student login button -->
<!-- From: -->
<button ... id="submitBtn">
    <i class="fas fa-sign-in-alt me-1"></i> Login Siswa
</button>

<!-- To: -->
<button ... id="submitBtn">
    <i class="fas fa-sign-in-alt me-1"></i> Masuk Sebagai Siswa
</button>
```

### Change Error Messages

Edit in `UnifiedLoginController.php`:

```php
$request->validate([
    'nisn' => 'required|string|size:10',
], [
    'nisn.required' => 'NISN harus diisi',
    'nisn.size' => 'NISN harus 10 digit',
    // Change to:
    'nisn.required' => 'Silakan masukkan NISN Anda',
    'nisn.size' => 'NISN harus tepat 10 angka',
]);
```

### Change Success Messages

Add in controller after successful login:

```php
// Add this before redirect
return redirect()->route('student.dashboard')
    ->with('success', 'Login berhasil! Selamat datang di portal siswa.');
```

---

## Styling & Layout

### Change Login Container Width

Edit in CSS (search for `.login-wrapper`):

```css
.login-wrapper {
    width: 100%;
    max-width: 1000px; /* Current */
    /* Change to: */
    max-width: 1200px; /* Wider */
    /* OR */
    max-width: 800px; /* Narrower */
}
```

### Change Form Section Width

For asymmetric layout (e.g., 40% form, 60% carousel):

```css
.login-wrapper {
    grid-template-columns: 0.4fr 0.6fr; /* 40-60 split */
    /* Current is 1fr 1fr (50-50) */
    /* OR */
    grid-template-columns: 0.3fr 0.7fr; /* 30-70 split */
}
```

### Change Input Field Styling

```css
.form-group input {
    padding: 0.75rem 1rem; /* Current */
    /* Change to: */
    padding: 1rem 1.25rem; /* Larger padding */

    border-radius: 10px; /* Current */
    /* Change to: */
    border-radius: 5px; /* Less rounded */
    border-radius: 20px; /* More rounded (pill) */
}
```

### Change Button Styling

```css
.btn-login {
    padding: 0.85rem; /* Current */
    /* Change to: */
    padding: 1rem; /* Larger buttons */

    border-radius: 10px; /* Current */
    /* Change to: */
    border-radius: 5px; /* Sharp corners */

    font-size: 1rem; /* Current */
    /* Change to: */
    font-size: 1.1rem; /* Bigger text */
}
```

### Change Carousel Height

```css
.carousel-section {
    min-height: 500px; /* Current */
    /* Change to: */
    min-height: 600px; /* Taller */
    /* OR */
    height: 100%; /* Fill parent */
}
```

### Hide Carousel on Desktop

```css
@media (min-width: 769px) {
    /* New: hide on desktop */
    .carousel-section {
        display: none;
    }

    .login-wrapper {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    /* Existing: hide on mobile */
    .carousel-section {
        display: none;
    }
}
```

---

## Advanced Customization

### Add Two-Factor Authentication

1. Add phone field to form:

```html
<div class="form-group">
    <label for="phone">Nomor WhatsApp</label>
    <input type="tel" id="phone" name="phone" placeholder="+62..." />
</div>
```

2. Update controller:

```php
public function loginStudent(Request $request)
{
    // ... existing validation ...

    // After Hash::check succeeds:
    $otp = random_int(100000, 999999);
    cache()->put('otp_' . $student->id, $otp, now()->addMinutes(5));

    // Send via WhatsApp
    \App\Services\WhatsAppService::send($request->phone, "OTP Anda: $otp");

    return view('auth.verify-otp', ['student_id' => $student->id]);
}
```

### Add Google/GitHub Login

1. Install Laravel Socialite:

```bash
composer require laravel/socialite
```

2. Add buttons to form:

```html
<div class="form-group">
    <a href="/auth/google" class="btn btn-outline-primary btn-block">
        <i class="fab fa-google"></i> Login dengan Google
    </a>
</div>
```

3. Create routes and controller method

### Add Dark Mode

1. Update CSS:

```css
body.dark-mode {
    background-color: #1a1a1a;
    color: #f0f0f0;
}

body.dark-mode .login-wrapper {
    background: #2a2a2a;
}

body.dark-mode .form-group input {
    background: #3a3a3a;
    color: #f0f0f0;
    border-color: #555;
}
```

2. Add toggle button:

```html
<button id="darkModeToggle" style="position: absolute; top: 20px; right: 20px;">
    <i class="fas fa-moon"></i>
</button>

<script>
    document.getElementById("darkModeToggle").addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");
        localStorage.setItem(
            "darkMode",
            document.body.classList.contains("dark-mode"),
        );
    });

    // Load preference
    if (localStorage.getItem("darkMode") === "true") {
        document.body.classList.add("dark-mode");
    }
</script>
```

### Add Biometric Authentication

```html
<button
    type="button"
    id="biometricBtn"
    style="margin-top: 1rem; width: 100%; padding: 0.75rem;"
>
    <i class="fas fa-fingerprint"></i> Login dengan Fingerprint
</button>

<script>
    document
        .getElementById("biometricBtn")
        .addEventListener("click", async () => {
            try {
                const credential = await navigator.credentials.get({
                    publicKey: {
                        challenge: new Uint8Array(32),
                        rpId: "sekolah.local",
                        userVerification: "preferred",
                    },
                });
                // Handle biometric login
            } catch (error) {
                console.error("Biometric auth failed:", error);
            }
        });
</script>
```

### Add Accessibility Features

```html
<!-- Add ARIA labels -->
<input
    id="nisn"
    name="nisn"
    aria-label="Nomor Induk Siswa Nasional"
    aria-describedby="nisn-help"
/>
<small id="nisn-help">10 digit NISN Anda</small>

<!-- Add skip links -->
<a href="#loginForm" class="skip-link">Lompat ke form login</a>

<!-- Add focus indicators -->
<style>
    input:focus-visible {
        outline: 3px solid var(--primary-blue);
    }
</style>
```

### Add Language Switcher

```html
<div style="position: absolute; top: 10px; right: 10px;">
    <select id="languageSelect" onchange="changeLanguage(this.value)">
        <option value="id">Bahasa Indonesia</option>
        <option value="en">English</option>
    </select>
</div>

<script>
    function changeLanguage(lang) {
        // Load translations
        const translations = {
            id: {
                submit: "Login Siswa",
                nisn: "NISN",
                password: "Password",
            },
            en: {
                submit: "Login Student",
                nisn: "Student ID",
                password: "Password",
            },
        };

        // Update text
        document.querySelectorAll("[data-i18n]").forEach((el) => {
            const key = el.getAttribute("data-i18n");
            el.textContent = translations[lang][key];
        });
    }
</script>
```

---

## Quick Copy-Paste Customizations

### Professional Blue Theme

```css
:root {
    --primary-blue: #1e3a8a;
    --secondary-yellow: #fbbf24;
    --dark-blue: #0f172a;
}

.carousel-section {
    background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%);
}
```

### Corporate Green Theme

```css
:root {
    --primary-blue: #059669;
    --secondary-yellow: #fcd34d;
    --dark-blue: #064e3b;
}

.carousel-section {
    background: linear-gradient(135deg, #d1fae5 0%, #ecfdf5 100%);
}
```

### Modern Purple Theme

```css
:root {
    --primary-blue: #7c3aed;
    --secondary-yellow: #fbbf24;
    --dark-blue: #581c87;
}

.carousel-section {
    background: linear-gradient(135deg, #ede9fe 0%, #f3e8ff 100%);
}
```

### Minimal Gray Theme

```css
:root {
    --primary-blue: #4b5563;
    --secondary-yellow: #f3f4f6;
    --dark-blue: #1f2937;
}

.carousel-section {
    background: linear-gradient(135deg, #e5e7eb 0%, #f3f4f6 100%);
}
```

---

## Testing After Customization

After making changes, test:

1. ✅ Form still works
2. ✅ Login functionality unchanged
3. ✅ Carousel still rotates
4. ✅ Toggle buttons work
5. ✅ Mobile responsive
6. ✅ No console errors
7. ✅ All colors visible
8. ✅ Buttons clickable

---

**Remember**: All customizations should be tested on both desktop and mobile!
