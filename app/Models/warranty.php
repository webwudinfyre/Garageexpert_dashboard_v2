<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class warranty extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'Start_date',
        'end_date',
        'warranty_type',
    ];


    public function Product_add() :BelongsTo {
        return $this->belongsTo(Product_add::class,'warranties_id','id');
    }
}
