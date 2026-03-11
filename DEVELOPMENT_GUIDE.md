# Panduan Pengembangan Website SDIT Labitech Insan Mulia

## Daftar Isi

1. [Instalasi & Setup](#instalasi--setup)
2. [Struktur Project](#struktur-project)
3. [Menambah Berita](#menambah-berita)
4. [Customization](#customization)
5. [Deployment](#deployment)

## Instalasi & Setup

### Prerequisites

- PHP 8.1+
- MySQL 8.0+
- Composer
- Node.js & NPM

### Langkah-Langkah Instalasi

```bash
# 1. Masuk ke folder project
cd g:\laragon\www\sekolah

# 2. Install dependencies PHP
composer install

# 3. Install dependencies Node
npm install

# 4. Generate app key (jika belum ada)
php artisan key:generate

# 5. Setup database (sudah ada di .env)
# Edit file .env jika perlu menyesuaikan database config

# 6. Run migration dan seeder
php artisan migrate --seed

# 7. Build assets
npm run build

# 8. Jalankan development server
php artisan serve

# 9. Akses website
# http://localhost:8000 atau http://sekolah.test (sesuai config Laragon)
```

### Menggunakan Laragon

Jika menggunakan Laragon, pastikan sudah ditambahkan ke virtual hosts:

```
g:\laragon\www\sekolah sekolah.test
```

Kemudian akses: http://sekolah.test

## Struktur Project

```
sekolah/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── PageController.php         # Controller untuk halaman publik
│   │   └── Middleware/
│   ├── Models/
│   │   └── News.php                        # Model untuk berita
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   └── 2026_02_20_000000_create_news_table.php
│   ├── seeders/
│   │   └── NewsSeeder.php                  # Seeder untuk data contoh
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php               # Master layout
│   │   ├── index.blade.php                 # Halaman beranda
│   │   ├── about.blade.php                 # Halaman tentang kami
│   │   ├── news.blade.php                  # Halaman daftar berita
│   │   └── news-detail.blade.php           # Halaman detail berita
│   ├── css/
│   │   └── app.css
│   └── js/
│       ├── app.js
│       └── bootstrap.js
├── routes/
│   ├── web.php                             # Routing aplikasi
│   └── console.php
├── public/
│   ├── index.php
│   └── storage/                            # Folder untuk upload file
├── .env                                    # Environment variables
├── .env.example
├── composer.json
├── package.json
└── vite.config.js
```

## Menambah Berita

### Method 1: Menggunakan Tinker (Interactive Shell)

```bash
# 1. Buka tinker
php artisan tinker

# 2. Buat berita baru
App\Models\News::create([
    'title' => 'Judul Berita Anda',
    'slug' => 'judul-berita-anda',
    'content' => 'Isi konten berita Anda di sini...',
    'excerpt' => 'Ringkasan singkat berita...',
    'featured_image' => null, // atau 'path/to/image.jpg'
    'category' => 'Berita Sekolah',
    'author' => 'Nama Author',
    'is_published' => true,
    'published_at' => now(),
]);

# 3. Exit tinker
exit
```

### Method 2: Membuat Seeder Custom

1. Buat seeder baru:

```bash
php artisan make:seeder CustomNewsSeeder
```

2. Edit file `database/seeders/CustomNewsSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomNewsSeeder extends Seeder
{
    public function run(): void
    {
        News::create([
            'title' => 'Berita Terbaru SDIT Labitech',
            'slug' => Str::slug('Berita Terbaru SDIT Labitech'),
            'content' => 'Konten berita di sini...',
            'excerpt' => 'Ringkasan berita...',
            'category' => 'Berita',
            'author' => 'Admin',
            'published_at' => now(),
        ]);
    }
}
```

3. Daftarkan di `DatabaseSeeder.php`:

```php
$this->call([
    NewsSeeder::class,
    CustomNewsSeeder::class, // Tambahkan ini
]);
```

4. Jalankan seeder:

```bash
php artisan db:seed --class=CustomNewsSeeder
```

### Method 3: Membuat Admin Panel (Future Development)

Untuk kemudahan, dapat menambahkan admin panel menggunakan:

- Laravel Nova
- Filament
- Voyager
- Custom CRUD

## Customization

### Mengubah Warna Theme

Edit file `resources/views/layouts/app.blade.php` pada bagian CSS `:root`:

```css
:root {
    --primary-blue: #0066cc; /* Warna biru utama */
    --secondary-yellow: #ffd700; /* Warna kuning sekunder */
    --dark-blue: #1a3a5c; /* Warna biru gelap */
    --light-gray: #f8f9fa; /* Warna abu-abu terang */
}
```

### Mengubah Logo/Brand

1. Ganti di navbar (line ~115):

```blade
<a class="navbar-brand" href="{{ route('home') }}">
    <i class="fas fa-school"></i> SDIT LABITECH
</a>
```

2. Atau tambahkan image logo:

```blade
<a class="navbar-brand" href="{{ route('home') }}">
    <img src="/images/logo.png" alt="Logo" height="40">
</a>
```

### Menambah Menu Navigasi

Edit file `resources/views/layouts/app.blade.php`:

```blade
<li class="nav-item">
    <a class="nav-link" href="{{ route('contact') }}">Kontak</a>
</li>
```

### Mengubah Footer

Edit bagian footer di `resources/views/layouts/app.blade.php` (mulai dari line ~260).

## Deployment

### Persiapan untuk Production

1. Update file `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://sekolah.test
```

2. Generate optimized autoloader:

```bash
composer install --optimize-autoloader --no-dev
```

3. Cache konfigurasi:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

4. Build assets untuk production:

```bash
npm run build
```

5. Set permissions yang benar:

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Upload ke Server

1. Upload semua file kecuali:
    - `node_modules/` (sudah di .gitignore)
    - `.env.example`
    - `.git/`

2. Clone di server:

```bash
git clone <repository-url>
cd sekolah
composer install --no-dev
npm install
npm run build
php artisan migrate --force
```

3. Konfigurasi web server (Apache/Nginx) agar document root mengarah ke `public/`

### SSL/HTTPS

Pastikan domain sudah memiliki SSL certificate. Dapat menggunakan Let's Encrypt.

## Troubleshooting

### Database Connection Error

```bash
# Check konfigurasi database di .env
php artisan migrate --force
```

### Permission Denied Error

```bash
chmod -R 755 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

### Assets tidak tampil

```bash
# Rebuild assets
npm run build

# Atau untuk development
npm run dev
```

### Clear cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Fitur yang Dapat Dikembangkan

- [ ] Admin dashboard untuk mengelola berita
- [ ] Upload image/file untuk berita
- [ ] Galeri foto/video
- [ ] Sistem formulir kontak
- [ ] Newsletter/Email subscription
- [ ] Search functionality
- [ ] Blog categories dan tags
- [ ] Comments system
- [ ] PDF export untuk dokumen
- [ ] Multi-language support
- [ ] Social media integration
- [ ] Analytics integration
- [ ] SEO optimization
- [ ] Mobile app

## Useful Commands

```bash
# Database
php artisan migrate              # Run migrations
php artisan migrate:rollback     # Rollback migrations
php artisan db:seed             # Run seeders
php artisan tinker              # Interactive shell

# Cache
php artisan cache:clear         # Clear all cache
php artisan config:cache        # Cache configuration

# Development
php artisan serve               # Start dev server
npm run dev                     # Start Vite hot reload
npm run build                   # Build for production

# Maintenance
php artisan down                # Put app in maintenance
php artisan up                  # Bring app back up

# Model & Migration
php artisan make:model News -m  # Create model with migration
php artisan make:seeder NewsSeeder
php artisan make:controller NewsController
```

## Referensi Dokumentasi

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.0/)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [Blade Templates](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)

---

**Last Updated**: 20 February 2026
**Version**: 1.0
**Developed for**: SDIT Labitech Insan Mulia
