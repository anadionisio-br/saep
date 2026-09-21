<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nome',
        'cnpj',
        'responsavel',
        'telefone',
        'email',
    ];

    public $timestamps = true;


    public function setCnpjAttribute($valor)
    {
        $this->attributes['cnpj'] = Crypt::encryptString($valor);
    }


    public function getCnpjAttribute($valor)
    {
        try {
            return Crypt::decryptString($valor);
        } catch (DecryptException $e) {
            return $valor;
        }
    }


    public function salas()
    {
        return $this->hasMany(Sala::class);
    }
}
