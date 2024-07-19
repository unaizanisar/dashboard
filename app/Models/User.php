<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'address',
        'gender',
        'phone',
        'status',
        'profile_photo',
        'role_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function permissions()
{
    return $this->belongsToMany(Permission::class, 'roles_has_permissions', 'role_id', 'permission_id');
}
}
