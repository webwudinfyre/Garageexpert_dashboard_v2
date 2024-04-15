<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class techUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'phonenumber',
        'linkedin',
        'facebook',
        'instagram',
        'twitter',
        'avatar',
        'Address',
        'Position',
        'Gender'
    ];
    public function users() :BelongsTo
    {
        return $this->belongsTo(User::class ,'user_id','id');
    }
    public function tech_user_rew(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
