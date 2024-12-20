<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function adminUser() : HasMany
    {
       return $this->hasMany(AdminUser::class,'user_id','id');
    }
    public function adminUserprofile() : HasOne
    {
       return $this->hasOne(AdminUser::class,'user_id','id');
    }
    public function techUser() : HasMany
    {
       return $this->hasMany(techUser::class,'user_id','id');
    }
    public function clientUser() : HasMany
    {
       return $this->hasMany(ClientUser::class,'user_id','id');
    }
    public function notifications() : HasMany
    {
       return $this->hasMany(Notification::class,'admin_id','id');
    }
    public function unreadNotifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'admin_id', 'id')
            ->whereNull('read_at');
    }
    // public function adminUser1()
    // {
    //     return $this->hasOne(AdminUser::class,'user_id','id');
    // }
    public function scopeOrderByStatus($query, $order = 'asc')
    {
        return $query->orderBy('status', $order);
    }
}
