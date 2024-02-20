<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'user_id',
    ];

    public function users() :BelongsTo
    {
        return $this->belongsTo(User::class ,'user_id','id');
    }






}
