@extends('layouts.app')

@section('titulo', 'Editar Sala')

@section('conteudo')

    <div class="topo">
        <h1>Editar Sala</h1>
        <a href="/salas/listar"><button class="cinza">Voltar</button></a>
    </div>

    <form action="/salas/{{ $sala->id }}" method="POST">

        @csrf
        @method('PUT')

        <p><label>Nome da sala:</label>
        <input type="text" name="nome" value="{{ old('nome', $sala->nome) }}" required></p>

        <p><label>Capacidade:</label>
        <input type="number" name="capacidade" min="1" value="{{ old('capacidade', $sala->capacidade) }}" required></p>

        <p><label>Localização:</label>
        <input type="text" name="localizacao" value="{{ old('localizacao', $sala->localizacao) }}"></p>

        <p><label>Empresa:</label>
        <select name="empresa_id" required>

            @foreach($empresas as $empresa)
                <option value="{{ $empresa->id }}"
                    {{ old('empresa_id', $sala->empresa_id) == $empresa->id ? 'selected' : '' }}>
                    {{ $empresa->nome }}
                </option>
            @endforeach

        </select></p>

        <button type="submit">Salvar</button>

    </form>

@endsection
