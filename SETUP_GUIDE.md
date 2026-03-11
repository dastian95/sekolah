# SDIT Labitech Insan Mulia Website

Website resmi SDIT Labitech Insan Mulia yang dibangun menggunakan Laravel 11 dan Bootstrap 5.

## Fitur Utama

- **Halaman Beranda**: Menampilkan informasi utama, berita terbaru, dan video YouTube
- **Halaman Tentang Kami**: Informasi lengkap tentang visi, misi, nilai-nilai, dan keunggulan sekolah
- **Halaman Berita**: Tampilan berita dan artikel terkini dengan pagination
- **Responsive Design**: Website responsif dan dapat diakses dari berbagai perangkat
- **Modern UI**: Desain modern dengan warna tema biru dan kuning sesuai brand SDIT Labitech Insan Mulia

## Persyaratan Sistem

- PHP 8.1+
- Laravel 11.0+
- MySQL 8.0+
- Composer
- Node.js & NPM (untuk asset compilation)

## Instalasi

1. Clone repository atau ekstrak project ke folder laragon

```bash
cd g:\laragon\www\sekolah
```

2. Install dependencies PHP

```bash
composer install
```

3. Install dependencies JavaScript

```bash
npm install
```

4. Copy file .env

```bash
cp .env.example .env
```

5. Generate application key

```bash
php artisan key:generate
```

6. Setup database di file `.env`

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sekolah
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migration dan seeder

```bash
php artisan migrate --seed
```

8. Build assets

```bash
npm run build
```

## Menjalankan Website

1. Jalankan development server

```bash
php artisan serve
```

2. Akses website di browser

```
http://localhost:8000
```

Atau jika menggunakan Laragon:

```
http://sekolah.test (sesuaikan dengan konfigurasi Laragon)
```

## Struktur Project

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php      (Template utama)
│   ├── index.blade.php         (Halaman beranda)
│   ├── about.blade.php         (Halaman tentang kami)
│   └── news.blade.php          (Halaman berita)
│
app/
├── Http/
│   └── Controllers/
│       └── PageController.php  (Controller untuk halaman publik)
└── Models/
    └── News.php                (Model untuk berita)

database/
├── migrations/
│   └── 2026_02_20_000000_create_news_table.php
└── seeders/
    └── NewsSeeder.php          (Sample data berita)

routes/
└── web.php                     (Routing aplikasi)
```

## Route Aplikasi

| Method | URL           | Controller           | Nama Route | Deskripsi            |
| ------ | ------------- | -------------------- | ---------- | -------------------- |
| GET    | /             | PageController@index | home       | Halaman beranda      |
| GET    | /tentang-kami | PageController@about | about      | Halaman tentang kami |
| GET    | /berita       | PageController@news  | news       | Halaman berita       |

## Customization

### Menambah Warna Theme

Edit file `resources/views/layouts/app.blade.php` pada bagian `:root` CSS:

```css
:root {
    --primary-blue: #0066cc;
    --secondary-yellow: #ffd700;
    --dark-blue: #1a3a5c;
    --light-gray: #f8f9fa;
}
```

### Menambah News

```php
php artisan tinker
```

```php
App\Models\News::create([
    'title' => 'Judul Berita',
    'slug' => 'judul-berita',
    'content' => 'Isi berita...',
    'excerpt' => 'Ringkasan...',
    'category' => 'Kategori',
    'author' => 'Nama Author',
    'published_at' => now(),
]);
```

## Fitur yang Dapat Dikembangkan

- [ ] Sistem admin/dashboard untuk mengelola berita
- [ ] Galeri foto/video
- [ ] Sistem formulir kontak
- [ ] Newsletter subscription
- [ ] Search functionality
- [ ] Blog dengan kategori dan tag
- [ ] Sistem komentar berita
- [ ] PDF download untuk dokumen resmi
- [ ] Multi-language support
- [ ] Social media integration

## Troubleshooting

### Database Error

Pastikan database sudah dibuat dan konfigurasi `.env` sudah benar:

```bash
php artisan migrate
```

### Asset tidak tampil

Build ulang assets:

```bash
npm run build
```

Untuk development mode dengan hot reload:

```bash
npm run dev
```

### Permission error

Ubah permission folder storage dan bootstrap/cache:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Dokumentasi Lebih Lanjut

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [Font Awesome Icons](https://fontawesome.com/icons)

## License

Hak cipta © 2026 SDIT Labitech Insan Mulia. Semua hak dilindungi.

## Kontak

- **Email**: alvadasti@gmail.com
- **Telepon**: -
- **Website**: -

---

Dibuat dengan ❤️ untuk SDIT Labitech Insan Mulia
