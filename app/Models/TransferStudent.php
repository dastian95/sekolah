<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'transfer_number',
        'full_name',
        'gender',
        'birth_place',
        'birth_date',
        'previous_school',
        'current_class',
        'reason_transfer',
        'parent_name',
        'whatsapp_number',
        'address_short',
        'report_card_file',
        'transfer_letter_file',
        'status',
        'admin_note',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    // Helper untuk menampilkan status dengan warna badge Bootstrap
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
}
