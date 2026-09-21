@extends('layouts.app')

@section('titulo', 'Editar Empresa')

@section('conteudo')

    <div class="topo">
        <h1>Editar Empresa</h1>
        <a href="/empresas/listar"><button class="cinza">Voltar</button></a>
    </div>

    <form action="/empresas/{{ $empresa->id }}" method="POST">

        @csrf
        @method('PUT')

        <p><label>Nome:</label>
        <input type="text" name="nome" value="{{ old('nome', $empresa->nome) }}" required></p>

        <p><label>CNPJ:</label>
        <input type="text" name="cnpj" value="{{ old('cnpj', $empresa->cnpj) }}" required></p>

        <p><label>Responsável:</label>
        <input type="text" name="responsavel" value="{{ old('responsavel', $empresa->responsavel) }}"></p>

        <p><label>Telefone:</label>
        <input type="text" name="telefone" value="{{ old('telefone', $empresa->telefone) }}"></p>

        <p><label>E-mail:</label>
        <input type="email" name="email" value="{{ old('email', $empresa->email) }}"></p>

        <button type="submit">Salvar</button>

    </form>

@endsection
