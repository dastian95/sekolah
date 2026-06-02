<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['title', 'issued_by', 'issued_date', 'description', 'file_path', 'thumbnail', 'is_active', 'sort_order'];

    protected $casts = [
        'is_active'   => 'boolean',
        'issued_date' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
