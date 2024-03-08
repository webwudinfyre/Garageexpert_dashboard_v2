<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];
    protected $fillable = [
        'data',
        'read_at',
        'admin_id',
        'product_tasks_id',

    ];
    public function prdt_task(): HasOne
    {
        return $this->HasOne(product_task::class, 'id', 'product_tasks_id');
    }
}
