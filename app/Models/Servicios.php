<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;

    protected $fillable = [
            'servicio'
    ];

    public function citas(){
        return $this->belongsTo(Citas::class);
    }
}
