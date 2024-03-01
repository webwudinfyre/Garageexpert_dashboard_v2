<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class product_add extends Model
{
    use HasFactory;

    protected $fillable = [
        // Add other fillable attributes here

        'client_id',
        'type_services_id',
        'equipment_id',
        'date_of_schedule',
        'Reamarks',
        'admin_id',
        'warranties_id',
        'product_code',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            do {
                $productCode = date('Ymd') . rand(10, 9999);
            } while (product_add::where('product_code', $productCode)->exists());

            $product->product_code = $productCode;
        });
    }

    public function Type_service(): HasOne
    {
        return $this->hasOne(type_service::class, 'id', 'typeservices_id');
    }
    public function warranty(): HasOne
    {
        return $this->hasOne(warranty::class, 'id', 'warranties_id');
    }

    public function client_pdt(): HasOne
    {
        return $this->hasOne(ClientUser::class, 'id', 'client_id');
    }
    public function equip_pdt(): HasOne
    {
        return $this->hasOne(Equipment::class, 'id', 'equipment_id');
    }
    public function users_pdt(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
