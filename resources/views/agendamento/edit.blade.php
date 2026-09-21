@extends('layouts.app')

@section('titulo', 'Editar Agendamento')

@section('conteudo')

    <div class="topo">
        <h1>Editar Agendamento</h1>
        <a href="/agendamentos/listar"><button class="cinza">Voltar</button></a>
    </div>

    <form action="/agendamentos/{{ $agendamento->id }}" method="POST">

        @csrf
        @method('PUT')

        <p><label>Data:</label>
        <input type="date" name="data" value="{{ old('data', $agendamento->data) }}" required></p>

        <p><label>Hora de início:</label>
        <input type="time" name="hora_inicio"
               value="{{ old('hora_inicio', substr($agendamento->hora_inicio, 0, 5)) }}" required></p>

        <p><label>Hora de término:</label>
        <input type="time" name="hora_fim"
               value="{{ old('hora_fim', substr($agendamento->hora_fim, 0, 5)) }}" required></p>

        <p><label>Responsável:</label>
        <input type="text" name="responsavel" value="{{ old('responsavel', $agendamento->responsavel) }}"></p>

        <p><label>Descrição:</label>
        <input type="text" name="descricao" value="{{ old('descricao', $agendamento->descricao) }}"></p>

        <p><label>Sala:</label>
        <select name="sala_id" required>

            @foreach($salas as $sala)
                <option value="{{ $sala->id }}"
                    {{ old('sala_id', $agendamento->sala_id) == $sala->id ? 'selected' : '' }}>
                    {{ $sala->nome }} - {{ $sala->empresa->nome }}
                </option>
            @endforeach

        </select></p>

        <button type="submit">Salvar</button>

    </form>

@endsection
