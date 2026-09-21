@extends('layouts.app')

@section('titulo', 'Novo Agendamento')

@section('conteudo')

    <div class="topo">
        <h1>Novo Agendamento</h1>
        <a href="/agendamentos/listar"><button class="cinza">Voltar</button></a>
    </div>

    <form action="/agendamentos" method="POST">

        @csrf

        <p><label>Data:</label>
        <input type="date" name="data" value="{{ old('data') }}" required></p>

        <p><label>Hora de início:</label>
        <input type="time" name="hora_inicio" value="{{ old('hora_inicio') }}" required></p>

        <p><label>Hora de término:</label>
        <input type="time" name="hora_fim" value="{{ old('hora_fim') }}" required></p>

        <p><label>Responsável:</label>
        <input type="text" name="responsavel" value="{{ old('responsavel') }}"></p>

        <p><label>Descrição:</label>
        <input type="text" name="descricao" value="{{ old('descricao') }}"></p>

        <p><label>Sala:</label>
        <select name="sala_id" required>

            <option value="">Selecione uma sala</option>

            @foreach($salas as $sala)
                <option value="{{ $sala->id }}"
                    {{ old('sala_id') == $sala->id ? 'selected' : '' }}>
                    {{ $sala->nome }} - {{ $sala->empresa->nome }}
                </option>
            @endforeach

        </select></p>

        <button type="submit">Cadastrar</button>

    </form>

@endsection
