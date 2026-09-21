@extends('layouts.app')

@section('titulo', 'Salas')

@section('conteudo')

<div class="pagina-salas">

    <div class="topo-pagina">

        <div class="titulo-pagina">

            <div class="icone-titulo">
                <i class="fa-solid fa-door-open"></i>
            </div>

            <div>
                <span class="subtitulo-pagina">
                    Gerenciamento
                </span>

                <h1>Salas</h1>

                <p>
                    Cadastre, consulte e gerencie os espaços disponíveis.
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
                <i class="fa-solid fa-door-open"></i>
                Salas cadastradas
            </h2>

            <p>
                Consulte e organize os espaços disponíveis.
            </p>
        </div>

        <a href="/salas/create" class="link-botao">
            <button type="button" class="botao-principal">
                <i class="fa-solid fa-plus"></i>
                Nova Sala
            </button>
        </a>

    </div>

    <div class="card-busca">

        <div class="titulo-busca">

            <div class="icone-busca">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>

            <div>
                <h2>Buscar sala</h2>

                <p>
                    Pesquise pelo nome ou localização da sala.
                </p>
            </div>

        </div>

        <form action="/salas/listar" method="GET" class="form-busca">

            <div class="campo-busca">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="busca"
                    placeholder="Nome ou localização"
                    value="{{ request('busca') }}"
                >

            </div>

            <button type="submit" class="botao-principal">
                <i class="fa-solid fa-search"></i>
                Pesquisar
            </button>

            <a href="/salas/listar" class="link-botao">
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
                    <i class="fa-solid fa-list"></i>
                    Lista de salas
                </h2>
            </div>

            <span class="contador">
                {{ $salas->count() }} sala(s)
            </span>

        </div>

        <div class="tabela-container">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Capacidade</th>
                        <th>Localização</th>
                        <th>Empresa</th>
                        <th>Ações</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($salas as $sala)

                    <tr>

                        <td>
                            <span class="id-sala">
                                #{{ $sala->id }}
                            </span>
                        </td>

                        <td>

                            <div class="nome-sala">

                                <div class="mini-icone">
                                    <i class="fa-solid fa-door-open"></i>
                                </div>

                                <strong>
                                    {{ $sala->nome }}
                                </strong>

                            </div>

                        </td>

                        <td>

                            <span class="capacidade">

                                <i class="fa-solid fa-users"></i>

                                {{ $sala->capacidade }}

                                pessoas

                            </span>

                        </td>

                        <td>

                            <span class="localizacao">

                                <i class="fa-solid fa-location-dot"></i>

                                {{ $sala->localizacao }}

                            </span>

                        </td>

                        <td>

                            <div class="empresa-info">

                                <div class="mini-icone empresa">
                                    <i class="fa-solid fa-building"></i>
                                </div>

                                <strong>
                                    {{ $sala->empresa->nome ?? '-' }}
                                </strong>

                            </div>

                        </td>

                        <td>

                            <div class="acoes">

                                <a
                                    href="/salas/{{ $sala->id }}/edit"
                                    class="botao-editar"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                    Editar
                                </a>

                                <form
                                    action="/salas/{{ $sala->id }}"
                                    method="POST"
                                    onsubmit="return confirm('Confirma a exclusão da sala?')"
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

                        <td colspan="6">

                            <div class="estado-vazio">

                                <div class="icone-vazio">
                                    <i class="fa-solid fa-door-closed"></i>
                                </div>

                                <h3>Nenhuma sala encontrada</h3>

                                <p>
                                    Não existem salas cadastradas para o termo pesquisado.
                                </p>

                                <a href="/salas/create">
                                    <button
                                        type="button"
                                        class="botao-principal"
                                    >
                                        <i class="fa-solid fa-plus"></i>
                                        Cadastrar sala
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