<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'contato',
        'empresa_id',
        'user_create_id',
        'user_update_id'
    ];

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }
}
