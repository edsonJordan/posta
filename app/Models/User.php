<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'last_name',
        'user',
        'rol_id',
        'password',
        'email',
        'photo',
        'telefono',
        'document',
        'idServicio'
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function servicio()
    {
        return $this->hasOne(Servicios::class, 'id', 'idServicio');
    }

    public function citas()
    {
        return $this->hasOne(Citas::class, 'idPaciente', 'id');
    }

    public function citas_data()
    {
        return $this->hasMany(Citas::class, 'idPaciente', 'id');
    }
}
