<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class product_add extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $fillable = [
        // Add other fillable attributes here

        'client_id',

        'equipment_id',
        'admin_id',
        'warranties_id',
        'product_code',
        'serial_no',
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
    public function product_task(): BelongsTo
    {
        return $this->belongsTo(product_task::class, 'id', 'product_id');
    }
    public function client_pdt_1(): BelongsTo
{
    return $this->belongsTo(ClientUser::class, 'client_id', 'id');
}


}
