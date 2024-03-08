<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class product_task extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_services_id',
        'date_of_schedule',
        'Reamarks',
        'admin_id',
        'product_id',
        'task_id', 'taskhistory',
    ];

    public function users_pdt(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
    public function Type_service(): HasOne
    {
        return $this->hasOne(type_service::class, 'id', 'type_services_id');
    }
    public function task(): HasOne
    {
        return $this->hasOne(task_data::class, 'id', 'task_id');
    }


    public function product_add(): HasOne
    {
        return $this->hasOne(product_add::class, 'product_id', 'product_id');
    }
    public function product_add_not(): HasOne
    {
        return $this->hasOne(product_add::class, 'product_id', 'product_id');
    }
}
