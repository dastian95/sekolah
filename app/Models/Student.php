<?php

namespace App\Models;

use App\Observers\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Student extends Authenticatable
{
    use HasFactory, Notifiable, Auditable;

    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        // Identitas
        'nisn',
        'nis',
        'nama',
        'jenis_kelamin',
        'nik',
        'warga_negara',
        
        // Registrasi
        'registration_number',
        'username',
        'password',
        'uid',
        
        // Akademik
        'kelas_awal',
        'tahun_masuk',
        'sekolah_asal',
        
        // Pribadi
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'hp',
        'email',
        'foto',
        
        // Keluarga
        'anak_ke',
        'status_keluarga',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        
        // Ayah
        'nama_ayah',
        'tgl_lahir_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'nohp_ayah',
        'alamat_ayah',
        
        // Ibu
        'nama_ibu',
        'tgl_lahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'nohp_ibu',
        'alamat_ibu',
        
        // Wali
        'nama_wali',
        'tgl_lahir_wali',
        'pendidikan_wali',
        'pekerjaan_wali',
        'nohp_wali',
        'alamat_wali',
        
        // Status
        'status',
        'admin_note',
        
        // Kelulusan
        'nilai_akhir',
        'keterangan',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tgl_lahir_ayah' => 'date',
        'tgl_lahir_ibu' => 'date',
        'tgl_lahir_wali' => 'date',
        'nilai_akhir' => 'decimal:2',
    ];

    // Helper untuk menampilkan status dengan warna badge Bootstrap (untuk tampilan nanti)
    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'warning',
            'contacted' => 'info',
            'verified'  => 'success',
            'rejected'  => 'danger',
            default     => 'secondary',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'Baru Daftar',
            'contacted' => 'Sedang Diproses',
            'verified'  => 'Diterima',
            'rejected'  => 'Tidak Diterima',
            default     => 'Tidak Diketahui',
        };
    }

    public function getStatusDescriptionAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'Data kamu sudah kami terima. Silakan lengkapi data jika ada yang kurang.',
            'contacted' => 'Pendaftaran kamu sedang kami tinjau. Data tidak bisa diubah selama proses ini.',
            'verified'  => 'Selamat! Kamu diterima sebagai peserta didik baru SDIT Labitech Insan Mulia.',
            'rejected'  => 'Maaf, pendaftaran kamu belum bisa kami terima saat ini. Silakan hubungi sekolah untuk informasi lebih lanjut.',
            default     => 'Status tidak diketahui.',
        };
    }

    public function canEditProfile(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Get the user who created the student record.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}