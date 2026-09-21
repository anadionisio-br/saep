@extends('layouts.app')

@section('titulo', 'Nova Empresa')

@section('conteudo')

    <div class="topo">
        <h1>Nova Empresa</h1>
        <a href="/empresas/listar"><button class="cinza">Voltar</button></a>
    </div>

    <form action="/empresas" method="POST">

        @csrf

        <p><label>Nome:</label>
        <input type="text" name="nome" value="{{ old('nome') }}" required></p>

        <p><label>CNPJ:</label>
        <input type="text" name="cnpj" value="{{ old('cnpj') }}" required></p>

        <p><label>Responsável:</label>
        <input type="text" name="responsavel" value="{{ old('responsavel') }}"></p>

        <p><label>Telefone:</label>
        <input type="text" name="telefone" value="{{ old('telefone') }}"></p>

        <p><label>E-mail:</label>
        <input type="email" name="email" value="{{ old('email') }}"></p>

        <button type="submit">Cadastrar</button>

    </form>

    <p style="color:#6b7280; font-size:13px;">
        O CNPJ é um dado sensível e será armazenado de forma criptografada.
    </p>

@endsection
