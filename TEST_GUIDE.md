# 🧪 QUICK TEST GUIDE - Portal Siswa

Panduan cepat untuk testing semua fitur Portal Siswa.

---

## ⚡ QUICK START

### 1. Run Database Migrations

```bash
php artisan migrate
```

Output expected:

```
Running migrations...
2026_03_02_000000_add_graduation_fields_to_students_table ........................ DONE
```

### 2. Clear All Cache

```bash
php artisan cache:clear
php artisan config:clear
```

### 3. Start Laravel Development Server

```bash
php artisan serve
```

URL: `http://localhost:8000`

---

## 📋 TEST SCENARIOS

### TEST 1: Student Registration

**URL**: `http://localhost:8000/student-register`

**Test Data**:

```
Nama Lengkap       : Budi Santoso
NISN               : 1234567890
NIS                : 12345
Jenis Kelamin      : L
Tempat Lahir       : Jakarta
Tanggal Lahir      : 15/01/2010
No. HP             : 081234567890
Email              : budi.santoso@test.com
Password           : Test12345
Konfirmasi Password: Test12345
```

**Expected Results**:

- ✅ Form diterima tanpa error
- ✅ Redirect ke student dashboard
- ✅ Logged in sebagai siswa
- ✅ Username auto-generated (budi-santoso)

**Verify di Database**:

```sql
SELECT nisn, nama, username, status FROM students WHERE nisn = '1234567890';
-- Output: 1234567890, Budi Santoso, budi-santoso, pending
```

---

### TEST 2: Student Login

**URL**: `http://localhost:8000/student-login`

**Test Data**:

```
NISN     : 1234567890
Password : Test12345
```

**Expected Results**:

- ✅ Form diterima
- ✅ Redirect ke student dashboard
- ✅ Navbar menampilkan student dropdown dengan nama "Budi Santoso"

---

### TEST 3: Student Dashboard

**URL**: `http://localhost:8000/student/dashboard` (after login)

**Expected Results**:

- ✅ Greeting "Selamat Datang, Budi Santoso!"
- ✅ 4 quick info cards terlihat:
    - Status Akademik: "Aktif"
    - Tahun Masuk: blank atau dari data
    - Jenis Kelamin: "Laki-laki"
    - WhatsApp button: link ke wa.me/...
- ✅ Menu Cepat dengan 3 links:
    - Informasi Lengkap
    - Status Kelulusan
    - Ubah Password (disabled)
- ✅ Logout button di bottom

---

### TEST 4: Student Profile

**URL**: `http://localhost:8000/student/profile` (after login)

**Expected Results**:

- ✅ Heading "Profil Lengkap - Budi Santoso"
- ✅ Tombol "Kembali" ke dashboard
- ✅ Semua data visible di sections:
    - Data Identitas (Nama, NISN, NIS, JK, NIK, Warga Negara)
    - Data Pribadi (Tempat lahir, DOB, Agama, Anak ke, Status keluarga)
    - Data Akademik (Tahun masuk, Kelas awal, Sekolah asal)
    - Data Kontak (Email, No. HP dengan link WhatsApp)
    - Data Alamat (Full address dengan RT/RW, Kelurahan, etc)
    - Data Orang Tua (Ayah, Ibu, Wali jika ada)
- ✅ Responsive pada mobile

---

### TEST 5: Graduation Status

**URL**: `http://localhost:8000/student/graduation-status` (after login)

**Initial Status** (status = pending):

**Expected Results**:

- ✅ Status badge: 🟡 "Menunggu Verifikasi" (orange)
- ✅ Alert info: "Status kelulusan Anda masih dalam proses verifikasi..."
- ✅ Detail Informasi:
    - Nama & NISN: Budi Santoso, 1234567890
    - Tahun Kelulusan: 2026 (calculated)
    - Status: Menunggu Verifikasi
- ✅ WhatsApp notification card (green)
- ✅ Status explanation guide (accordion style)
- ✅ Timeline showing registration date

**No Certificate Download Button** (karena status != verified)

---

### TEST 6: Update Status ke "Verified" (Admin)

**Via Database Query** (Temporary):

```sql
UPDATE students
SET status = 'verified',
    nilai_akhir = 85.5,
    keterangan = 'Lulus dengan nilai sempurna',
    admin_note = 'Data valid dan lengkap'
WHERE nisn = '1234567890';
```

**Or Via PhpMyAdmin**:

1. Go to students table
2. Find row dengan nisn = 1234567890
3. Edit columns:
    - status: verified
    - nilai_akhir: 85.5
    - keterangan: Lulus dengan nilai sempurna
    - admin_note: Data valid dan lengkap

**After Update - Check Graduation Status Page**:

**Expected Results**:

- ✅ Status badge berubah: 🟢 "Lulus" (green)
- ✅ Alert success: "Selamat! Anda dinyatakan lulus..."
- ✅ Detail Informasi updated:
    - Nilai Akhir: 85.5
    - Keterangan: Lulus dengan nilai sempurna
    - Status: Lulus
- ✅ Download Certificate button muncul
- ✅ Timeline updated dengan lulus date

---

### TEST 7: Logout

**From Dashboard**:

1. Scroll ke bottom
2. Klik tombol "Logout" (merah)

**Expected Results**:

- ✅ Redirect ke student login page
- ✅ Flash message: "Anda berhasil logout"
- ✅ Session cleared
- ✅ Can't access dashboard directly (redirect ke login)

**Verify**:

- Try access `http://localhost:8000/student/dashboard` directly
- Should redirect ke login page

---

### TEST 8: Navigation Navbar

**When NOT Logged In**:

- ✅ "Login Admin" link (orange)
- ✅ "Login Siswa" button (green)

**When Logged In as Student**:

- ✅ Hide "Login Siswa" button
- ✅ Show "Budi Santoso" dropdown (green)
- ✅ Dropdown items:
    - Dashboard Siswa
    - Profil Saya
    - Status Kelulusan
    - Logout Siswa

**When Logged In as Admin**:

- ✅ Show "Admin: [Name]" dropdown (orange)
- ✅ Dropdown items:
    - Dasbor Admin
    - Logout Admin

---

## 🔍 VALIDATION TESTS

### Test NISN Validation

**Form**: Student Register

**Test 1 - NISN < 10 digit**:

```
NISN: 123456789 (9 digit)
```

Expected: Error message "NISN must be 10 characters"

**Test 2 - NISN > 10 digit**:

```
NISN: 12345678901 (11 digit)
```

Expected: Error message "NISN must be 10 characters"

**Test 3 - Duplicate NISN**:

```
NISN: 1234567890 (sudah ada di database)
```

Expected: Error message "NISN already registered"

---

### Test Email Validation

**Form**: Student Register

**Test 1 - Invalid email format**:

```
Email: budi.santoso (tanpa @)
```

Expected: Error message "Email must be a valid email address"

**Test 2 - Duplicate email**:

```
Email: budi.santoso@test.com (sudah ada)
```

Expected: Error message "Email has already been registered"

---

### Test Password Validation

**Form**: Student Register

**Test 1 - Password < 6 char**:

```
Password: Test12
```

Expected: Error message "Password must be at least 6 characters"

**Test 2 - Password tidak match**:

```
Password: Test12345
Confirm : Test12346
```

Expected: Error message "Passwords don't match"

---

### Test HP Validation

**Form**: Student Register

**Test 1 - Invalid format**:

```
HP: 081234567890 ✅ Valid (10 digit after 08)
HP: 0812345678   ❌ Invalid (too short)
HP: 629812345678 ❌ Invalid (starts with 62)
```

---

## 💾 DATABASE VERIFICATION

### Check Users Created

```sql
SELECT id_siswa, nisn, nama, username, email, status, created_at
FROM students
ORDER BY created_at DESC
LIMIT 10;
```

Expected output:

```
| id_siswa | nisn        | nama           | username      | status   |
|----------|-------------|----------------|---------------|----------|
| 1        | 1234567890  | Budi Santoso   | budi-santoso  | pending  |
```

### Check Graduation Fields

```sql
SELECT nisn, nama, status, nilai_akhir, keterangan
FROM students
WHERE nisn = '1234567890';
```

Expected output:

```
| nisn       | nama         | status   | nilai_akhir | keterangan               |
|------------|--------------|----------|-------------|--------------------------|
| 1234567890 | Budi Santoso | verified | 85.50       | Lulus dengan nilai... |
```

---

## 🔐 SECURITY TESTS

### Test 1: Password Hashing

```sql
SELECT nisn, nama, password FROM students WHERE nisn = '1234567890';
```

Expected:

- ✅ Password is hashed (looks like `$2y$12$...`)
- ✅ Not plain text

### Test 2: Session Protection

1. Login sebagai student
2. Copy session cookie
3. Open incognito window
4. Paste cookie
5. Try access dashboard

Expected:

- ✅ Can access dashboard (session valid)
- ✅ Logout clears session

### Test 3: CSRF Protection

1. Open form di student register
2. Inspect HTML, cari `@csrf`
3. Submit form

Expected:

- ✅ Form token ada
- ✅ Form submitted successfully
- ✅ CSRF protection working

---

## 📊 LOAD TESTING (Optional)

### Test dengan 100+ Students

```sql
-- Generate test data
INSERT INTO students (nisn, nis, nama, username, password, email, hp, status, created_at, updated_at)
VALUES
  ('1000000001', '00001', 'Student 1', 'student-1', 'hashed_pw', 's1@test.com', '081234567890', 'pending', NOW(), NOW()),
  ('1000000002', '00002', 'Student 2', 'student-2', 'hashed_pw', 's2@test.com', '081234567891', 'verified', NOW(), NOW()),
  ...
```

### Check Performance

1. Access `/student/dashboard`
2. Check load time (target < 500ms)
3. Check `/student/profile` (more fields)
4. Check `/student/graduation-status`

Expected:

- ✅ All pages load fast
- ✅ No query N+1 issues
- ✅ Responsive design works

---

## ✅ FINAL CHECKLIST

Before considering the portal "ready for production":

- [ ] All 8 test scenarios pass
- [ ] No validation errors
- [ ] Database integration works
- [ ] Navbar shows correctly
- [ ] Session management works
- [ ] CSRF protection enabled
- [ ] Password hashing verified
- [ ] Responsive on mobile (test with DevTools)
- [ ] All links work
- [ ] Error messages are helpful
- [ ] No console errors
- [ ] No Laravel error logs

---

## 🚨 TROUBLESHOOTING

### Issue: "NISN validation fails"

**Fix**:

- Check validation rule in StudentAuthController
- NISN harus exactly 10 digits
- No spaces or special characters

### Issue: "Login tidak bekerja"

**Fix**:

- Check password hashing di database
- Verify NISN format (10 digits)
- Check auth guard di config/auth.php

### Issue: "Dashboard shows empty data"

**Fix**:

- Check student record di database
- Verify all fields filled
- Check fillable array di Student model

### Issue: "Navbar not showing student menu"

**Fix**:

- Check auth:students guard
- Verify session working
- Clear cache: `php artisan cache:clear`

---

## 📞 NEXT STEPS AFTER TESTING

1. ✅ Test complete & verified
2. 🔧 Implement WhatsApp integration (optional)
3. 🎨 Polish UI/UX based on feedback
4. 📱 Test on real mobile devices
5. 🚀 Deploy to production
6. 📊 Monitor performance & errors
7. 🔄 Collect user feedback
8. 🐛 Bug fixes & optimization

---

**Happy Testing! 🎉**

For any issues, refer to:

- PANDUAN_PORTAL_SISWA.md
- Code comments
- Laravel documentation

---

Generated: 03 March 2026
