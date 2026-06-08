<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionLog extends Model
{
    protected $fillable = ['furniture_id', 'old_condition', 'new_condition', 'note', 'changed_at'];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
