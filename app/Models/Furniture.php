<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    protected $fillable = [
        'code', 'category_id', 'location_id', 'name', 'material', 'color', 
        'size', 'weight', 'stock', 'minimum_stock', 'condition', 
        'image', 'description', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function conditionLogs()
    {
        return $this->hasMany(ConditionLog::class);
    }
}
