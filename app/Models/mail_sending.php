<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mail_sending extends Model
{
    use HasFactory;
    protected $fillable = [
        // Add other fillable attributes here
        'name',
        'product_tasks_id',
        'product_id',
        'email',
    ];
}
