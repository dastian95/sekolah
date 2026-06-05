# Deployment Guide - Hostinger via GitHub Actions

## ✅ Perbaikan yang sudah dilakukan:

1. ✅ Update FTP-Deploy-Action ke v4.3.6 (compatible dengan Node.js 20+)
2. ✅ Update ssh-action ke v1.1.0
3. ✅ Tambah `php artisan down/up` untuk zero-downtime deployment
4. ✅ Tambah `queue:restart` untuk job queue
5. ✅ Exclude storage/logs dan bootstrap/cache dari upload

---

## 📋 Checklist Setup di GitHub

Anda **HARUS** set secrets berikut di GitHub repository:

### FTP Credentials (untuk upload files):
- `FTP_SERVER` - Hostname FTP Hostinger (contoh: `ftp.namadomains.com` atau IP)
- `FTP_USERNAME` - Username FTP Hostinger
- `FTP_PASSWORD` - Password FTP Hostinger
- `FTP_SERVER_DIR` - Path folder di server (contoh: `/public_html` atau `/`)

### SSH Credentials (untuk jalankan artisan commands):
- `SSH_HOST` - Hostname/IP server
- `SSH_USERNAME` - Username SSH
- `SSH_PASSWORD` - Password SSH (atau gunakan SSH key)
- `SSH_PORT` - Port SSH (default: 22)
- `SSH_PROJECT_DIR` - Path folder project di server (contoh: `/home/username/public_html`)

### Cara set secrets di GitHub:
1. Buka repository → **Settings** → **Secrets and variables** → **Actions**
2. Klik **New repository secret**
3. Isi `Name` dan `Value` untuk masing-masing secret
4. Klik **Add secret**

---

## 🔍 Checklist di Hostinger

### 1. Setup FTP
- Login ke cPanel Hostinger
- File Manager → Cari folder project Anda
- Catat **path lengkap** folder project (contoh: `/home/username/public_html/sekolah`)
- Buat FTP account jika belum ada (cPanel → FTP Accounts)

### 2. Setup SSH
- Login ke cPanel Hostinger
- Terminal → SSH Access
- Pastikan SSH sudah enabled
- Catat hostname dan port SSH

### 3. Folder Permissions
Pastikan folder project memiliki permission yang tepat:
```bash
chmod 755 storage/
chmod 755 bootstrap/cache/
chmod 644 .env
```

### 4. .env File
**PENTING:** File `.env` tidak boleh di-upload via FTP (sudah di-exclude di workflow).

Cara manual setup:
1. SSH ke server
2. Copy dari `.env.example` atau buat baru:
```bash
cd /path/to/project
cp .env.example .env
# Edit .env sesuai kebutuhan production
php artisan key:generate
```

### 5. Database
- Pastikan database credentials di `.env` sudah benar
- Pastikan database user sudah ada dan memiliki privileges
- Run migration dengan `php artisan migrate --force`

---

## 🚀 Testing Deployment

### Test 1: Manual Push
```bash
git add .
git commit -m "test: deployment test"
git push origin main
```
Lihat progress di GitHub → Actions → Workflow runs

### Test 2: Check Logs
- Klik workflow run yang sedang/sudah berjalan
- Lihat output dari masing-masing step
- Jika ada error, baca message dengan detail

### Test 3: SSH Verification
Setelah deployment selesai, SSH ke server dan verify:
```bash
cd /path/to/project
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

---

## 🐛 Troubleshooting

### Error: "FTP connection failed"
- Verifikasi credentials di GitHub Secrets
- Pastikan FTP account active di Hostinger
- Cek firewall/security di Hostinger tidak memblokir

### Error: "SSH permission denied"
- Pastikan SSH credentials benar
- Cek `SSH_PROJECT_DIR` path benar
- Pastikan user SSH memiliki akses ke folder project

### Error: "php: command not found"
- Pastikan PHP path di Hostinger correct
- Di SSH, jalankan: `which php` atau cek `/usr/bin/php`
- Update script jika path berbeda

### Error: "Artisan commands timeout"
- Bisa jadi migration terlalu lama
- Cek file migration di `database/migrations/`
- Jalankan manual di server dulu sebelum auto-deploy

### Database migration error
- Pastikan `.env` database credentials benar
- Cek user database memiliki CREATE/ALTER table privileges
- Jalankan: `php artisan migrate:status` untuk lihat status

---

## 📚 File Workflow Reference

**Location:** `.github/workflows/deploy.yml`

Workflow berjalan otomatis ketika:
- Ada `push` ke branch `main`
- Atau manual trigger dari Actions tab

**Steps yang dijalankan:**
1. Checkout code dari repository
2. Setup PHP 8.2
3. Install composer dependencies
4. Deploy files via FTP
5. Run artisan commands via SSH

---

## 💡 Tips

- Test semua di local/staging dulu sebelum push ke main
- Backup database production sebelum migration
- Monitor logs di `storage/logs/` setelah deploy
- Set notification GitHub jika ada failed deploy

---

## 📞 Support Resources

- [Hostinger Documentation](https://support.hostinger.com)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- [GitHub Actions for PHP](https://github.com/features/actions)
