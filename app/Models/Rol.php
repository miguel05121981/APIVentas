<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Rol extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'rols';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'permission_rol',
            'rol_id',
            'permission_id'
        )
        ->withPivot(['user_create', 'user_update'])
        ->withTimestamps();
    }
}