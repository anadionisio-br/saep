<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    /**
     * A senha nunca e exposta em serializacoes do model (LGPD).
     */
    protected $hidden = [
        'senha',
    ];

    public $timestamps = true;
}
