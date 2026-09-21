@extends('layouts.app')

@section('titulo', 'Agendamentos')

@section('conteudo')

<div class="pagina-agendamentos">

    <div class="topo-pagina">

        <div class="titulo-pagina">

            <div class="icone-titulo">
                <i class="fa-solid fa-calendar-days"></i>
            </div>

            <div>
                <span class="subtitulo-pagina">
                    Gerenciamento
                </span>

                <h1>Agendamentos</h1>

                <p>
                    Consulte e gerencie os agendamentos dos espaços.
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
                <i class="fa-solid fa-calendar-check"></i>
                Agendamentos cadastrados
            </h2>

            <p>
                Os agendamentos estão organizados por data.
            </p>
        </div>

        <a href="/agendamentos/create" class="link-botao">
            <button type="button" class="botao-principal">
                <i class="fa-solid fa-plus"></i>
                Novo Agendamento
            </button>
        </a>

    </div>

    <div class="card-tabela">

        <div class="tabela-topo">

            <div>
                <h2>
                    <i class="fa-solid fa-list"></i>
                    Lista de agendamentos
                </h2>
            </div>

            <span class="contador">
                {{ $agendamentos->count() }} agendamento(s)
            </span>

        </div>

        <div class="tabela-container">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Responsável</th>
                        <th>Descrição</th>
                        <th>Sala</th>
                        <th>Capacidade</th>
                        <th>Localização</th>
                        <th>Empresa</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($agendamentos as $agendamento)

                    <tr>

                        <td>
                            <span class="id-agendamento">
                                #{{ $agendamento->id }}
                            </span>
                        </td>

                        <td>
                            <span class="data-agendamento">
                                <i class="fa-solid fa-calendar"></i>
                                {{ date('d/m/Y', strtotime($agendamento->data)) }}
                            </span>
                        </td>

                        <td>
                            <span class="horario">
                                <i class="fa-solid fa-clock"></i>
                                {{ substr($agendamento->hora_inicio, 0, 5) }}
                                -
                                {{ substr($agendamento->hora_fim, 0, 5) }}
                            </span>
                        </td>

                        <td>
                            <span class="responsavel">
                                <i class="fa-solid fa-user"></i>
                                {{ $agendamento->responsavel }}
                            </span>
                        </td>

                        <td>
                            <span class="descricao">
                                {{ $agendamento->descricao }}
                            </span>
                        </td>

                        <td>
                            <div class="sala-info">

                                <div class="mini-icone sala">
                                    <i class="fa-solid fa-door-open"></i>
                                </div>

                                <strong>
                                    {{ $agendamento->sala->nome }}
                                </strong>

                            </div>
                        </td>

                        <td>
                            <span class="capacidade">
                                <i class="fa-solid fa-users"></i>
                                {{ $agendamento->sala->capacidade }}
                            </span>
                        </td>

                        <td>
                            <span class="localizacao">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ $agendamento->sala->localizacao }}
                            </span>
                        </td>

                        <td>
                            <div class="empresa-info">

                                <div class="mini-icone empresa">
                                    <i class="fa-solid fa-building"></i>
                                </div>

                                <strong>
                                    {{ $agendamento->sala->empresa->nome }}
                                </strong>

                            </div>
                        </td>

                        <td>
                            <span class="informacao">
                                <i class="fa-solid fa-phone"></i>
                                {{ $agendamento->sala->empresa->telefone }}
                            </span>
                        </td>

                        <td>
                            <span class="informacao">
                                <i class="fa-solid fa-envelope"></i>
                                {{ $agendamento->sala->empresa->email }}
                            </span>
                        </td>

                        <td>

                            <div class="acoes">

                                <a
                                    href="/agendamentos/{{ $agendamento->id }}/edit"
                                    class="botao-editar"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                    Editar
                                </a>

                                <form
                                    action="/agendamentos/{{ $agendamento->id }}"
                                    method="POST"
                                    onsubmit="return confirm('Confirma a exclusão do agendamento?')"
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

                        <td colspan="12">

                            <div class="estado-vazio">

                                <div class="icone-vazio">
                                    <i class="fa-solid fa-calendar-xmark"></i>
                                </div>

                                <h3>Nenhum agendamento encontrado</h3>

                                <p>
                                    Ainda não existem agendamentos cadastrados.
                                </p>

                                <a href="/agendamentos/create">
                                    <button
                                        type="button"
                                        class="botao-principal"
                                    >
                                        <i class="fa-solid fa-plus"></i>
                                        Criar agendamento
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