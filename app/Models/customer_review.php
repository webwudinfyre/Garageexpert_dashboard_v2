<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class customer_review extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'tech_user_id',

        'product_tasks_id',
        'type_services_id',
        'admin_id',
        'product_id',
        'client_id',
        'tech_user_id',
        'equipment_id',
        'Product_reviews_star',
        'Product_reviews',
        'tech_reviews_star',
        'tech_reviews',
    ];
    public function Type_service(): HasOne
    {
        return $this->hasOne(type_service::class, 'id', 'type_services_id');
    }
    public function product_task_rew(): HasOne
    {
        return $this->hasOne(product_task::class, 'id', 'product_tasks_id');
    }
    public function equip_pdt_rew(): HasOne
    {
        return $this->hasOne(Equipment::class, 'id', 'equipment_id');
    }
    public function tech_user_rew(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'tech_user_id');
    }
}
