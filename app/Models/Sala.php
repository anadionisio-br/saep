<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'salas';

    protected $fillable = [
        'nome',
        'capacidade',
        'localizacao',
        'empresa_id',
    ];

    public $timestamps = true;

    /**
     * Toda sala pertence obrigatoriamente a uma empresa.
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
