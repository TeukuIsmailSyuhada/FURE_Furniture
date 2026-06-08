<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $fillable = ['furniture_id', 'type', 'quantity', 'note', 'transaction_date'];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
