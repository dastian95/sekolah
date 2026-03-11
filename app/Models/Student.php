<?php

namespace App\Models;

use App\Observers\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',   // Kuning
            'contacted' => 'info',    // Biru Muda
            'verified' => 'success',  // Hijau
            'rejected' => 'danger',   // Merah
            default => 'secondary',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'contacted' => 'Sedang Dihubungi',
            'verified' => 'Diterima',
            'rejected' => 'Ditolak',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Get the user who created the student record.
     */
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id_admin');
    }

    /**
     * Get the user who last updated the student record.
     */
    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by', 'id_admin');
    }
}