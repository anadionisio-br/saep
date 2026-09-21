<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/empresas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/salas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/agendamentos.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'SAEP - Gestão de Espaços')</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f2f4f7;
            color: #1f2933;
            margin: 0;
            padding: 24px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #d9dee5;
            border-radius: 8px;
            padding: 24px;
        }
        h1 { margin-top: 0; font-size: 22px; }
        h2 { font-size: 17px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #d9dee5; padding: 8px; text-align: left; font-size: 14px; }
        th { background: #eef2f7; }
        label { display: inline-block; min-width: 130px; font-size: 14px; }
        input, select { padding: 6px; border: 1px solid #c3cbd6; border-radius: 4px; min-width: 240px; }
        button { padding: 7px 14px; border: none; border-radius: 4px; background: #2563eb; color: #fff; cursor: pointer; }
        button.cinza { background: #6b7280; }
        button.vermelho { background: #b91c1c; }
        a { color: #2563eb; }
        .msg-ok { background: #e7f6ec; border: 1px solid #9ad2ae; padding: 10px; border-radius: 4px; }
        .msg-erro { background: #fdeaea; border: 1px solid #e5a1a1; padding: 10px; border-radius: 4px; }
        .topo { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px; margin-bottom: 16px; }
        .acoes form { display: inline; }
    </style>
</head>
<body>
    <div class="container">

        @if(session('success'))
            <p class="msg-ok">{{ session('success') }}</p>
        @endif

        @if(session('erro'))
            <p class="msg-erro">{{ session('erro') }}</p>
        @endif

        @if($errors->any())
            <div class="msg-erro">
                <ul>
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('conteudo')

    </div>
</body>
</html>
