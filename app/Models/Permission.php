<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'module',
        'status',
    ];
    public function roles()
        {
            return $this->belongsToMany(Role::class, 'roles_has_permissions', 'role_id', 'permission_id');
        }
}
