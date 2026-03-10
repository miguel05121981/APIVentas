<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class License extends Model
{
    use HasFactory;

    protected $table = 'licenses';

    protected $fillable = [
        'id',
        'code',
        'amount',
        'start_date',
        'end_date',
        'status',
        'active',
    ];

    protected $casts = [
        'amount'     => 'decimal:2',
        'start_date' => 'date',
        'end_date'   => 'date',
        'active'     => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('active', true)
                    ->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    public function getIsExpiredAttribute()
    {
        return $this->end_date && $this->end_date->isPast();
    }
}