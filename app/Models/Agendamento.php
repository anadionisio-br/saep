<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $table = 'agendamentos';

    protected $fillable = [
        'data',
        'hora_inicio',
        'hora_fim',
        'responsavel',
        'descricao',
        'sala_id',
    ];

    public $timestamps = true;


    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
