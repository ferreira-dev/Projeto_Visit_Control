<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prestadores_id',
        'user_update_id',
        'motivo',
        'obs',
    ];
}
