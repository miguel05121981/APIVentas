<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LocationType extends Model
{
    protected $table = 'location_type';

    protected $fillable = [
        'name',
        'user_create',
        'user_update',
        'active'
    ];

    /**
     * Usuario que creó el registro
     */
    public function userCreate()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    /**
     * Usuario que actualizó el registro
     */
    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'user_update');
    }
}
