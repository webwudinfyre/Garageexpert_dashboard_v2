<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClientUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
       'phonenumber',
        'office',
       'location',
       'suboffice',
       'Website',
       'facebook',
       'instagram',
       'twitter',
       'avatar',
       'Address',
       'Position',
       'Gender',
    ];

    public function users() :BelongsTo
    {
        return $this->belongsTo(User::class ,'user_id','id');
    }


    public function Product_add() :BelongsTo {
        return $this->belongsTo(product_add::class,'client_id','id');
    }


    public function Product_add_client() :HasMany {
        return $this->hasMany(product_add::class,'client_id','id');
    }


}
