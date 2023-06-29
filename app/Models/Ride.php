<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;
    protected $fillable = [
        'datetime',
        'passengers',
        'vagas',
        'from',
        'destiny',
        'status',
        'driver_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function passageiros()
    {
        return $this->belongsToMany(User::class);
    }

    public function motorista()
    {
        return $this->belongsTo(User::class);
    }
}
