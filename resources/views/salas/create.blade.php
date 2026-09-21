@extends('layouts.app')

@section('titulo', 'Nova Sala')

@section('conteudo')

    <div class="topo">
        <h1>Nova Sala</h1>
        <a href="/salas/listar"><button class="cinza">Voltar</button></a>
    </div>

    <form action="/salas" method="POST">

        @csrf

        <p><label>Nome da sala:</label>
        <input type="text" name="nome" value="{{ old('nome') }}" required></p>

        <p><label>Capacidade:</label>
        <input type="number" name="capacidade" min="1" value="{{ old('capacidade') }}" required></p>

        <p><label>Localização:</label>
        <input type="text" name="localizacao" value="{{ old('localizacao') }}"></p>

        {{-- Regra de negócio: toda sala deve ser associada a uma empresa --}}
        <p><label>Empresa:</label>
        <select name="empresa_id" required>

            <option value="">Selecione uma empresa</option>

            @foreach($empresas as $empresa)
                <option value="{{ $empresa->id }}"
                    {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>
                    {{ $empresa->nome }}
                </option>
            @endforeach

        </select></p>

        <button type="submit">Cadastrar</button>

    </form>

@endsection
