<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'phonenumber',
        'Website',
        'facebook',
        'instagram',
        'twitter',
        'avatar',
        'Address',
        'Position',
        'Gender',
    ];
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
