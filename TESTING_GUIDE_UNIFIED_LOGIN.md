# 🧪 Unified Login Testing Guide - Post Fix

## Quick Test Checklist

### Before You Test

- [ ] Browser cache cleared (Ctrl+Shift+Delete)
- [ ] Page refreshed (F5 or Ctrl+R)
- [ ] Laravel cache cleared (already done ✅)

---

## Test 1: Login Page Access ✅

**URL**: http://sekolah.local/login

**What to Look For**:

- [ ] Page loads without error
- [ ] No "RouteNotFoundException" message
- [ ] Unified login form appears with:
    - [ ] "Masuk" heading
    - [ ] Toggle buttons: "Siswa" (blue, default) and "Admin" (orange)
    - [ ] Form fields visible
    - [ ] Carousel on the right side (desktop) / hidden (mobile)
    - [ ] 5 carousel slides with indicators

**Expected Result**: ✅ Page loads perfectly

---

## Test 2: Carousel Functionality ✅

**On the Login Page**:

**Auto-Rotation**:

- [ ] Carousel automatically rotates every 5 seconds
- [ ] Slide transitions smoothly (fade effect)
- [ ] Indicator dots update as slides change

**Manual Navigation**:

- [ ] Click on different indicator dots
- [ ] Carousel changes to corresponding slide immediately
- [ ] Indicator highlights the active slide

**Carousel Content**:

- [ ] Slide 1: Daftar Mudah (easy registration)
- [ ] Slide 2: Dashboard Personal
- [ ] Slide 3: Data Lengkap (complete data)
- [ ] Slide 4: Status Kelulusan (graduation status)
- [ ] Slide 5: Aman & Terpercaya (secure & trusted)

**Expected Result**: ✅ Carousel works smoothly

---

## Test 3: Student Login ✅

**Setup**:

- Have valid student credentials ready
- Know a student's NISN (10 digits)

**Steps**:

1. [ ] Go to http://sekolah.local/login
2. [ ] Toggle should show "Siswa" selected (blue)
3. [ ] Form shows:
    - [ ] NISN field
    - [ ] Password field
    - [ ] "Ingat saya" checkbox
4. [ ] Enter valid NISN (e.g., 1234567890)
5. [ ] Enter password
6. [ ] Optionally check "Ingat saya"
7. [ ] Click "Login Siswa" button

**Expected Results**:

- ✅ Form submits without error
- ✅ Redirects to /student/dashboard
- ✅ Dashboard displays student info
- ✅ Navbar shows student name dropdown

**Error Testing**:

1. [ ] Try NISN with wrong length (less than 10 digits)
    - Expected: Validation error appears
2. [ ] Try valid NISN but wrong password
    - Expected: Error message "NISN atau password salah"
3. [ ] Leave NISN or password blank
    - Expected: Validation error

---

## Test 4: Admin Login ✅

**Setup**:

- Have valid admin credentials ready
- Know admin email or username

**Steps**:

1. [ ] Go to http://sekolah.local/login
2. [ ] Click toggle "Admin" (turns orange)
3. [ ] Form changes to show:
    - [ ] Email/Username field
    - [ ] Password field
    - [ ] "Ingat saya" checkbox
4. [ ] Enter email (admin@sekolah.id) OR username
5. [ ] Enter password
6. [ ] Optionally check "Ingat saya"
7. [ ] Click "Login Admin" button

**Expected Results**:

- ✅ Form submits without error
- ✅ Redirects to /admin/students
- ✅ Admin panel displays
- ✅ Navbar shows admin name dropdown

**Error Testing**:

1. [ ] Try email that doesn't exist
    - Expected: Error message "Email/Username atau password salah"
2. [ ] Try username with wrong password
    - Expected: Error message "Email/Username atau password salah"
3. [ ] Leave fields blank
    - Expected: Validation error

---

## Test 5: Form Toggle Functionality ✅

**Steps**:

1. [ ] Go to http://sekolah.local/login
2. [ ] Verify "Siswa" is selected (blue)
    - [ ] NISN field visible
    - [ ] "Login Siswa" button visible
    - [ ] Register link visible
3. [ ] Click "Admin" toggle
    - [ ] "Admin" becomes selected (orange)
    - [ ] "Siswa" becomes unselected
    - [ ] NISN field hidden
    - [ ] Email/Username field visible
    - [ ] "Login Admin" button visible
    - [ ] Register link hidden
4. [ ] Click "Siswa" toggle again
    - [ ] Switches back to student login form
5. [ ] Toggle multiple times
    - [ ] Form changes smoothly each time
    - [ ] Data persists if you didn't clear

**Expected Result**: ✅ Toggle works perfectly

---

## Test 6: Navbar Integration ✅

**When Not Logged In**:

1. [ ] Go to homepage (/)
2. [ ] Look at navbar top right
3. [ ] Should see button: "Masuk / Login"
4. [ ] Click button
    - [ ] Redirects to /login
    - [ ] Shows unified login page

**When Logged In as Student**:

1. [ ] Successfully login as student
2. [ ] Check navbar
3. [ ] Should see: "Student: [Student Name]"
4. [ ] Click dropdown arrow
    - [ ] Shows dropdown menu
    - [ ] "Dashboard Siswa" option visible
    - [ ] "Profil Saya" option visible
    - [ ] "Status Kelulusan" option visible
    - [ ] "Logout" option visible
5. [ ] Click each option
    - [ ] Dashboard → redirects to /student/dashboard
    - [ ] Profile → redirects to /student/profile
    - [ ] Graduation → redirects to /student/graduation-status
    - [ ] Logout → redirects to home

**When Logged In as Admin**:

1. [ ] Successfully login as admin
2. [ ] Check navbar
3. [ ] Should see: "Admin: [Admin Name]"
4. [ ] Click dropdown arrow
    - [ ] Shows dropdown menu
    - [ ] "Dasbor Admin" option visible
    - [ ] "Logout" option visible
5. [ ] Click options
    - [ ] Dashboard → redirects to /admin/students
    - [ ] Logout → redirects to home

**Expected Result**: ✅ Navbar works correctly

---

## Test 7: Logout Functionality ✅

**Steps**:

1. [ ] Login successfully (student or admin)
2. [ ] Verify you're in the dashboard
3. [ ] Click navbar dropdown (user name)
4. [ ] Click "Logout" button
5. [ ] Verify page behavior:
    - [ ] Redirected to home page (/)
    - [ ] Navbar shows "Masuk / Login" button again
    - [ ] Cannot access /student/dashboard or /admin/students
    - [ ] Session is cleared

**Expected Result**: ✅ Logout works, session cleared

---

## Test 8: Responsive Design ✅

**Desktop (1024px+)**:

- [ ] Two-column layout visible
- [ ] Login form on left
- [ ] Carousel on right
- [ ] All readable and accessible

**Tablet (768px - 1023px)**:

- [ ] Layout adjusts
- [ ] Form still visible
- [ ] Carousel visible (may be smaller)
- [ ] Buttons remain clickable

**Mobile (<768px)**:

- [ ] Only login form visible
- [ ] Carousel hidden
- [ ] Form takes full width
- [ ] All buttons touch-friendly
- [ ] No horizontal scrolling
- [ ] Toggle buttons stack or adjust

**Testing**:

1. [ ] Resize browser window
2. [ ] Or use DevTools (F12)
3. [ ] Test at 1920px, 768px, 375px widths
4. [ ] All features work at each size

**Expected Result**: ✅ Responsive design works perfectly

---

## Test 9: Security Features ✅

**CSRF Protection**:

- [ ] Form submits successfully
- [ ] @csrf token included (check form source)
- [ ] No CSRF validation errors

**Password Handling**:

- [ ] Passwords display as dots (masked)
- [ ] Passwords never appear in logs
- [ ] Passwords hashed in database

**Session Security**:

- [ ] Login creates session
- [ ] Session stored securely
- [ ] Logout invalidates session

**Expected Result**: ✅ Security features intact

---

## Test 10: Browser Compatibility ✅

Test on Multiple Browsers:

**Chrome/Chromium**:

- [ ] Page loads correctly
- [ ] Carousel works
- [ ] Forms submit properly

**Firefox**:

- [ ] Page loads correctly
- [ ] Carousel works
- [ ] Forms submit properly

**Safari**:

- [ ] Page loads correctly
- [ ] Carousel works
- [ ] Forms submit properly

**Edge**:

- [ ] Page loads correctly
- [ ] Carousel works
- [ ] Forms submit properly

**Mobile Browsers**:

- [ ] Chrome Android: works
- [ ] Safari iOS: works
- [ ] Touch navigation works

**Expected Result**: ✅ Works on all browsers

---

## Summary Checklist

### Critical Tests (Must Pass)

- [ ] Test 1: Login page loads without error
- [ ] Test 2: Carousel displays and rotates
- [ ] Test 3: Student login works
- [ ] Test 4: Admin login works
- [ ] Test 6: Navbar integration works
- [ ] Test 7: Logout works

### Important Tests (Should Pass)

- [ ] Test 5: Form toggle works
- [ ] Test 8: Responsive design works
- [ ] Test 9: Security features work
- [ ] Test 10: Browser compatibility

### Test Results

**Total Tests**: 10
**Passed**: [ ] / 10
**Failed**: [ ] / 10

**Overall Status**: ******\_\_\_******

---

## Common Issues & Solutions

### Issue: Still seeing "Route not found" error

**Solution**:

1. Hard refresh: Ctrl+F5 (Windows) or Cmd+Shift+R (Mac)
2. Clear browser cache:
    - Ctrl+Shift+Delete
    - Select "All time"
    - Clear "Cookies and other site data"
3. Close browser completely, reopen
4. Visit /login again

### Issue: Forms not submitting

**Solution**:

1. Check browser console (F12)
2. Look for JavaScript errors
3. Verify CSRF token is present
4. Try different browser

### Issue: Carousel not rotating

**Solution**:

1. Check browser console (F12)
2. Verify JavaScript is enabled
3. Try refreshing page
4. Try different browser

### Issue: Can't login with valid credentials

**Solution**:

1. Verify credentials are correct
2. Check student/admin exists in database
3. Verify password is correctly hashed
4. Check database connection

---

## Success Criteria

**The system is working correctly when**:
✅ Login page loads at /login
✅ Carousel auto-rotates every 5 seconds
✅ Students can login with NISN
✅ Admins can login with email/username
✅ Navbar shows correct buttons/dropdowns
✅ Logout works for both user types
✅ Page is responsive on all devices
✅ All security features are intact

---

**Test Date**: ******\_\_\_******
**Tested By**: ******\_\_\_******
**Overall Result**: ******\_\_\_******

---

If all tests pass, the unified login system is **production-ready**! 🎉
