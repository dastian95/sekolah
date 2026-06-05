# Manual Setup via SSH - Hostinger

Jika GitHub Actions terus error, lakukan setup manual via SSH lebih dulu.

## 📋 SSH Credentials Anda:
- **Host:** 185.232.14.83
- **Port:** 65002
- **Username:** u526782559
- **Password:** Imam#Juara2026!

## 🔧 Step-by-Step Setup Manual

### Step 1: SSH ke Hostinger
Gunakan terminal/PuTTY/MobaXterm:

```bash
ssh -p 65002 u526782559@185.232.14.83
# Password: Imam#Juara2026!
```

### Step 2: Navigate ke folder project
```bash
cd /home/u526782559/public_html
```

### Step 3: Check apa yang sudah ada
```bash
ls -la
# Lihat file/folder apa saja yang sudah ada dari FTP upload sebelumnya
```

### Step 4: Backup .env jika ada
```bash
cp .env .env.backup 2>/dev/null || true
```

### Step 5: Initialize git (jika belum ada .git)
```bash
git init
git remote add origin https://github.com/dastian95/sekolah.git
git fetch origin main
git checkout -f main
```

### Step 6: Update git (jika sudah ada .git)
```bash
git fetch origin main
git reset --hard origin/main
```

### Step 7: Restore .env (PENTING!)
```bash
# Restore original .env
cp .env.backup .env 2>/dev/null || true

# Atau buat .env baru
cat > .env << 'EOF'
APP_NAME=Sekolah
APP_ENV=production
APP_KEY=base64:YOUR_KEY_HERE
APP_DEBUG=false
APP_URL=https://labitech.sch.id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u526782559_sekolah
DB_USERNAME=u526782559_user
DB_PASSWORD=YOUR_DB_PASSWORD_HERE
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_unicode_ci
EOF
```

### Step 8: Install dependencies
```bash
composer install --no-dev --optimize-autoloader --no-interaction --no-scripts --ignore-platform-reqs
```

### Step 9: Generate key (jika belum ada)
```bash
php artisan key:generate
```

### Step 10: Run migrations
```bash
php artisan migrate --force
```

### Step 11: Create storage link
```bash
php artisan storage:link
```

### Step 12: Cache configuration
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 13: Set permissions
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
```

### Step 14: Test deployment
```bash
php artisan tinker
# Di dalam tinker, ketik:
# >>> exit
```

---

## ✅ Verify Installation

Setelah semua step selesai, cek:

```bash
# Cek git status
git status

# Cek composer packages
composer list

# Cek laravel version
php artisan --version

# Cek database connection
php artisan migrate:status
```

---

## 🚀 Setelah Manual Setup Berhasil

Jika manual setup berhasil:
1. Baru aktifkan GitHub Actions deployment
2. Setiap push ke `main` akan auto-deploy
3. Workflow akan pull latest code dan run migrations

---

## 📌 Tips

- **Jangan commit .env ke git** (sudah di .gitignore)
- **Database credentials** harus di-set di .env manual
- **APP_KEY** bisa di-generate dengan `php artisan key:generate`
- **Storage link** harus exist di `/public/storage`

Lakukan manual setup dulu, baru GitHub Actions akan bekerja dengan baik!
