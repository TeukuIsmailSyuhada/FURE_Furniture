<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Category
 * Mewakili klasifikasi/kategori untuk pengelompokan furniture.
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Relasi hasMany ke Furniture (satu kategori bisa memiliki banyak furniture).
     */
    public function furnitures()
    {
        return $this->hasMany(Furniture::class);
    }
}
