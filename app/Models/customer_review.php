<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class customer_review extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Type_service(): HasOne
    {
        return $this->hasOne(type_service::class, 'id', 'type_services_id');
    }
    public function product_task_rew(): HasOne
    {
        return $this->hasOne(product_task::class, 'id', 'product_tasks_id');
    }
}
