<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task_tech_report extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_task_id',
        'tech_user_id',
         'date_of_schedule',
        'date',
    ];




}
