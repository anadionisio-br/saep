@extends('layouts.app')

@section('titulo', 'Principal - SAEP Gestão de Espaços')

@section('conteudo')

<div class="pagina-principal">

    <div class="topo">

        <div class="topo-info">
            <div class="icone-sistema">
                <i class="fa-solid fa-building"></i>
            </div>

            <div>
                <h1>Gestão de Espaços</h1>

                <p>
                    Bem-vindo,
                    <strong>{{ session('usuario_nome') }}</strong>
                </p>
            </div>
        </div>

        <form action="/logout" method="POST">
            @csrf

            <button type="submit" class="botao-sair">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sair
            </button>
        </form>

    </div>

    <div class="cabecalho-menu">
        <div>
            <span class="titulo-secao">
                <i class="fa-solid fa-grid-2"></i>
                Recursos do sistema
            </span>

            <h2>Acesso rápido</h2>

            <p>
                Selecione uma opção para continuar.
            </p>
        </div>
    </div>

    <div class="cards-menu">

        <a href="/empresas/listar" class="card-menu">

            <div class="card-icone empresas">
                <i class="fa-solid fa-building"></i>
            </div>

            <div class="card-conteudo">
                <h3>Empresas</h3>

                <p>
                    Cadastre e gerencie as empresas do sistema.
                </p>
            </div>

            <div class="card-seta">
                <i class="fa-solid fa-arrow-right"></i>
            </div>

        </a>

        <a href="/salas/listar" class="card-menu">

            <div class="card-icone salas">
                <i class="fa-solid fa-door-open"></i>
            </div>

            <div class="card-conteudo">
                <h3>Salas</h3>

                <p>
                    Consulte e organize os espaços disponíveis.
                </p>
            </div>

            <div class="card-seta">
                <i class="fa-solid fa-arrow-right"></i>
            </div>

        </a>

        <a href="/agendamentos/listar" class="card-menu">

            <div class="card-icone agendamentos">
                <i class="fa-solid fa-calendar-days"></i>
            </div>

            <div class="card-conteudo">
                <h3>Agendamentos</h3>

                <p>
                    Gerencie reservas e horários dos espaços.
                </p>
            </div>

            <div class="card-seta">
                <i class="fa-solid fa-arrow-right"></i>
            </div>

        </a>

    </div>

    <div class="aviso-sessao">

        <div class="aviso-icone">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <div>
            <strong>Segurança da sessão</strong>

            <p>
                Por segurança, sua sessão expira automaticamente após
                <strong>{{ config('session.lifetime') }} minutos</strong>
                sem atividade.
            </p>
        </div>

    </div>

</div>

@endsection