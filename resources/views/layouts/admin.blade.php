<!DOCTYPE html>
<html>
<head>
    <title>Painel da Prefeitura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Prefeitura - Sistema de Ocorrências</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light">Sair</button>
            </form>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>
</body>
</html>