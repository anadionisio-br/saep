@extends('layouts.app')

@section('titulo', 'Empresas')

@section('conteudo')

<div class="pagina-empresas">

    <div class="topo-pagina">

        <div class="titulo-pagina">

            <div class="icone-titulo">
                <i class="fa-solid fa-building"></i>
            </div>

            <div>
                <span class="subtitulo-pagina">
                    Gerenciamento
                </span>

                <h1>Empresas</h1>

                <p>
                    Cadastre, consulte e gerencie as empresas do sistema.
                </p>
            </div>

        </div>

        <a href="/principal" class="link-botao">
            <button type="button" class="botao-cinza">
                <i class="fa-solid fa-arrow-left"></i>
                Voltar ao menu
            </button>
        </a>

    </div>

    <div class="barra-acoes">

        <div>
            <h2>
                <i class="fa-solid fa-list"></i>
                Empresas cadastradas
            </h2>

            <p>
                Consulte as empresas registradas no sistema.
            </p>
        </div>

        <a href="/empresas/create" class="link-botao">
            <button type="button" class="botao-principal">
                <i class="fa-solid fa-plus"></i>
                Nova Empresa
            </button>
        </a>

    </div>

    <div class="card-busca">

        <div class="titulo-busca">
            <div class="icone-busca">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>

            <div>
                <h2>Buscar empresa</h2>

                <p>
                    Pesquise por nome, responsável ou e-mail.
                </p>
            </div>
        </div>

        <form action="/empresas/listar" method="GET" class="form-busca">

            <div class="campo-busca">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="busca"
                    placeholder="Nome, responsável ou e-mail"
                    value="{{ request('busca') }}"
                >

            </div>

            <button type="submit" class="botao-principal">
                <i class="fa-solid fa-search"></i>
                Pesquisar
            </button>

            <a href="/empresas/listar" class="link-botao">
                <button type="button" class="botao-cinza">
                    <i class="fa-solid fa-rotate-left"></i>
                    Limpar
                </button>
            </a>

        </form>

    </div>

    <div class="card-tabela">

        <div class="tabela-topo">

            <div>
                <h2>
                    <i class="fa-solid fa-building"></i>
                    Lista de empresas
                </h2>
            </div>

            <span class="contador">
                {{ $empresas->count() }} empresa(s)
            </span>

        </div>

        <div class="tabela-container">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Responsável</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($empresas as $empresa)

                    <tr>

                        <td>
                            <span class="id-empresa">
                                #{{ $empresa->id }}
                            </span>
                        </td>

                        <td>
                            <div class="nome-empresa">
                                <div class="mini-icone">
                                    <i class="fa-solid fa-building"></i>
                                </div>

                                <strong>
                                    {{ $empresa->nome }}
                                </strong>
                            </div>
                        </td>

                        <td>
                            {{ $empresa->cnpj }}
                        </td>

                        <td>
                            {{ $empresa->responsavel }}
                        </td>

                        <td>
                            <span class="informacao">
                                <i class="fa-solid fa-phone"></i>
                                {{ $empresa->telefone }}
                            </span>
                        </td>

                        <td>
                            <span class="informacao">
                                <i class="fa-solid fa-envelope"></i>
                                {{ $empresa->email }}
                            </span>
                        </td>

                        <td>

                            <div class="acoes">

                                <a
                                    href="/empresas/{{ $empresa->id }}/edit"
                                    class="botao-editar"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                    Editar
                                </a>

                                <form
                                    action="/empresas/{{ $empresa->id }}"
                                    method="POST"
                                    onsubmit="return confirm('Confirma a exclusão da empresa?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="botao-excluir"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                        Excluir
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7">

                            <div class="estado-vazio">

                                <div class="icone-vazio">
                                    <i class="fa-solid fa-building-circle-xmark"></i>
                                </div>

                                <h3>Nenhuma empresa encontrada</h3>

                                <p>
                                    Não encontramos empresas para o termo pesquisado.
                                </p>

                                <a href="/empresas/create">
                                    <button type="button" class="botao-principal">
                                        <i class="fa-solid fa-plus"></i>
                                        Cadastrar empresa
                                    </button>
                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection