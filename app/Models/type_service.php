<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class type_service extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_name',
    ];

    public function Product_add() :BelongsTo {
        return $this->belongsTo(Product_add::class,'typeservices_id','id');
    }
}
