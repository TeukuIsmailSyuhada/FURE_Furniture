<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'description'];

    public function furnitures()
    {
        return $this->hasMany(Furniture::class);
    }
}
