<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];
    protected $fillable = [
        'data',
        'read_at',
        'admin_id',
        'product_tasks_id',

    ];
    public function prdt_task(): HasOne
    {
        return $this->HasOne(product_task::class, 'id', 'product_tasks_id');
    }
    public function clinet_id(): HasOne
    {
        return $this->HasOne(ClientUser::class, 'id', 'admin_id');
    }
    public function tech(): HasOne
    {
        return $this->HasOne(techUser::class, 'id', 'admin_id');
    }
    public function users(): HasOne
    {
        return $this->HasOne(User::class, 'id', 'admin_id');
    }
    public function tech_admin(): HasOne
    {
        return $this->HasOne(techUser::class, 'user_id', 'admin_id');
    }
}
