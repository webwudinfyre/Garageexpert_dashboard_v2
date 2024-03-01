<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'Brand',
        'Model',
        'Size',
        'Item_name',
    ];



    public function Product_add() :BelongsTo {
        return $this->belongsTo(Product_add::class,'equipment_id','id');
    }
}
