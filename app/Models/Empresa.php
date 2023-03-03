<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cnpj',
        'contato',
        'user_create_id',
        'user_update_id'
    ];

    public function prestadores() {
        return $this->hasMany(Prestador::class);
    }
}
