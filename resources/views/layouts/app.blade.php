<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Maintenance System</title>
    <link rel="stylesheet" href="{{ asset('css/app-custom.css') }}">
    @stack('styles')

</head>

<body>
    @php
        // Defina os e-mails (ou IDs) dos administradores aqui
        $admins = ['admin@example.com', 'outro@email.com'];
    @endphp

    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span style="font-size:1.3em;">🏙️</span>
                City Maintenance
            </a>
            <ul class="navbar-nav">
                <li><a class="nav-link" href="{{ route('issues.index') }}">Meus Reports</a></li>
                @auth
                    @if (in_array(auth()->user()->email, $admins))
                        <li>
                            <a class="nav-link" href="{{ route('issuesAdmin') }}">Painel Admin</a>
                        </li>
                    @endif
                @endauth
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">Cadastro</a></li>
                @else
                    <li style="display:flex;align-items:center;gap:0.5rem;">
                        <span style="color:#fff;">👤 {{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-link">Sair</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="container content-navbar-space" style="max-width:1100px;margin:0 auto;">
        @yield('content')
    </div>
    @stack('scripts')
</body>

</html>
