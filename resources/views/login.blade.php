<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Gestão de Espaços</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

    <div class="caixa">

        <h1>Gestão de Espaços</h1>

        <p class="sub">
            Acesso restrito - informe suas credenciais
        </p>

        {{-- Mensagem de falha na autenticação --}}
        @if (session('erro'))
            <p class="msg-erro">
                {{ session('erro') }}
            </p>
        @endif

        {{-- Erros de validação dos campos --}}
        @if ($errors->any())
            <ul class="lista-erros">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        @endif

        <form action="/login" method="POST">

            @csrf

            <div class="campo">
                <label for="email">E-mail:</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Digite seu e-mail"
                    required
                >
            </div>

            <div class="campo">
                <label for="senha">Senha:</label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    required
                >
            </div>

            <button type="submit">
                Entrar
            </button>

        </form>

    </div>

</body>

</html>