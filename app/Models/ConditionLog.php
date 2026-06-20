<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model ConditionLog
 * Menyimpan riwayat perubahan kondisi furniture.
 * Log dibuat otomatis oleh FurnitureController setiap kali kondisi berubah.
 */
class ConditionLog extends Model
{
    use HasFactory;

    protected $fillable = ['furniture_id', 'old_condition', 'new_condition', 'note', 'changed_at'];

    /**
     * Cast otomatis untuk field tanggal agar bisa diformat dengan Carbon.
     */
    protected $casts = [
        'changed_at' => 'datetime',
    ];

    /**
     * Relasi ke model Furniture (banyak log milik satu furniture).
     */
    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
