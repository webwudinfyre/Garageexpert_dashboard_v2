<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class signatures extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_tasks_id',
        'name',
        'postion',
        'signature_data',
        'email_id_sign',
        'phone_sign',
        'client_id',
    ];
}
