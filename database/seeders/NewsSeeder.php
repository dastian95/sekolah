<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsData = [
            [
                'title' => 'Kenangan Indah Siswa Kelas 6 SDIT Labitech Insan Mulia dalam Wisuda 2026',
                'content' => 'Siswa kelas 6 SDIT Labitech Insan Mulia mengakhiri masa sekolah dasar mereka dengan penuh kesan mendalam melalui acara wisuda yang meriah. Kegiatan ini menjadi momen kebersamaan terakhir mereka bersama teman-teman dan guru di SDIT Labitech Insan Mulia. Antusiasme para siswa terlihat dari berbagai aktivitas seru yang mereka ikuti bersama.',
                'excerpt' => 'Siswa kelas 6 SDIT Labitech Insan Mulia mengakhiri masa sekolah dasar mereka dengan penuh kesan...',
                'featured_image' => 'news/wisuda-2026.jpg',
                'category' => 'Berita Sekolah',
                'author' => 'Admin Labitech',
                'published_at' => now()->subDays(14),
            ],
            [
                'title' => 'Menyambut Ramadan, SDIT Labitech Insan Mulia Gelar Tarhib Ramadan 1447 H',
                'content' => 'Dalam rangka menyiapkan diri untuk menyambut bulan Ramadan, SDIT Labitech Insan Mulia menyelenggarakan acara Tarhib Ramadan atau persiapan menyambut Ramadan. Acara ini melibatkan seluruh siswa dan guru untuk memahami nilai-nilai spiritual dan moral dalam bulan Ramadan.',
                'excerpt' => 'Dalam rangka menyiapkan diri untuk menyambut bulan Ramadan, SDIT Labitech Insan Mulia...',
                'featured_image' => 'news/tarhib-ramadan.jpg',
                'category' => 'Acara',
                'author' => 'Admin Labitech',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Antusiasme Tinggi Calon Siswa Baru Ikuti PPDB SDIT Labitech Insan Mulia 2026',
                'content' => 'Ratusan calon siswa baru mengikuti proses Penerimaan Peserta Didik Baru (PPDB) SDIT Labitech Insan Mulia tahun 2026. Tingginya minat calon siswa menunjukkan kepercayaan masyarakat terhadap kualitas pendidikan yang diberikan oleh SDIT Labitech Insan Mulia.',
                'excerpt' => 'Ratusan calon siswa baru mengikuti proses Penerimaan Peserta Didik Baru (PPDB)...',
                'featured_image' => 'news/ppdb-2026.jpg',
                'category' => 'Pendaftaran',
                'author' => 'Admin Labitech',
                'published_at' => now()->subDays(11),
            ],
            [
                'title' => 'Siswa SDIT Labitech Insan Mulia Raih Juara Lomba Tahfidz Quran Se-Kota Bekasi',
                'content' => 'Siswa-siswi SDIT Labitech Insan Mulia berhasil meraih juara dalam lomba Tahfidz Quran tingkat Kota Bekasi. Prestasi ini menunjukkan komitmen sekolah dalam membina generasi Qurani yang berprestasi dan berakhlak mulia.',
                'excerpt' => 'Siswa-siswi SDIT Labitech Insan Mulia berhasil meraih juara dalam lomba Tahfidz Quran...',
                'featured_image' => 'news/tahfidz-quran.jpg',
                'category' => 'Prestasi',
                'author' => 'Admin Labitech',
                'published_at' => now()->subDays(13),
            ],
            [
                'title' => 'Kegiatan Pramuka SDIT Labitech Insan Mulia Gelar Perkemahan Karakter',
                'content' => 'Sebagai bagian dari pengembangan karakter dan kepemimpinan, SDIT Labitech Insan Mulia menggelar kegiatan Perkemahan Karakter. Kegiatan ini melibatkan siswa kelas 4 hingga kelas 6 untuk belajar tentang kepemimpinan, kerja sama tim, kemandirian, dan kedisiplinan.',
                'excerpt' => 'Sebagai bagian dari pengembangan karakter dan kepemimpinan, SDIT Labitech Insan Mulia...',
                'featured_image' => 'news/pramuka.jpg',
                'category' => 'Acara',
                'author' => 'Admin Labitech',
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'SDIT Labitech Insan Mulia Gelar Doa Bersama untuk Kelas 6 Jelang Ujian',
                'content' => 'SDIT Labitech Insan Mulia mengadakan kegiatan doa bersama untuk siswa kelas 6 dalam mempersiapkan ujian akhir. Kegiatan ini menunjukkan komitmen sekolah dalam memberikan dukungan moral dan spiritual kepada siswa.',
                'excerpt' => 'SDIT Labitech Insan Mulia mengadakan kegiatan doa bersama untuk siswa kelas 6...',
                'featured_image' => 'news/doa-bersama.jpg',
                'category' => 'Berita Sekolah',
                'author' => 'Admin Labitech',
                'published_at' => now()->subDays(16),
            ],
        ];

        foreach ($newsData as $data) {
            $data['slug'] = Str::slug($data['title']);
            News::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
