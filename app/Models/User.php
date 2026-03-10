<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'company_id',
        'rol_id',
        'user_create',
        'user_update',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',

        'company',
        'rol',
        'creator',
        'updater',
        'usersCreated',
        'usersUpdated',
        'getFullNameAttribute'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = [
        'company_name',
        'license_id'
    ];

    public function getCompanyNameAttribute()
    {
        return $this->company->name
        ? $this->company->name
        : null;
    }

    public function getLicenseIdAttribute()
    {
        return $this->company->license
        ? $this->company->license->id
        : null;
    }

    // 🔹 Empresa
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // 🔹 Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    // 🔹 Usuario creador
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    // 🔹 Usuario actualizador
    public function updater()
    {
        return $this->belongsTo(User::class, 'user_update');
    }

    // 🔹 Usuarios creados por este usuario
    public function usersCreated()
    {
        return $this->hasMany(User::class, 'user_create');
    }

    // 🔹 Usuarios actualizados por este usuario
    public function usersUpdated()
    {
        return $this->hasMany(User::class, 'user_update');
    }

    // Nombre completo automático
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
