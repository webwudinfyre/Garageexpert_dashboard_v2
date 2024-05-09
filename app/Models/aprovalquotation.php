<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aprovalquotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_task_id',
        'Refrence_number',
        'date_start',
        'date_end',
        'client_id'
    ];
}
