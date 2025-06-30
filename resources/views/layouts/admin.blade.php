<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Admin - CityConnect</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/app-custom.css') }}">
</head>
<body class="bg-gray-50">
  <!-- Navbar Admin -->
  <nav class="admin-navbar">
    <div class="container">
      <a href="{{ route('issuesAdmin') }}" class="admin-navbar-brand">
        <i class="fas fa-cogs"></i>
        <span>Painel Admin</span>
      </a>
      
      <div class="admin-navbar-menu">
          <a href="{{ route('home') }}" class="admin-nav-link">
            <i class="fas fa-home mr-1"></i> home
          </a>
          
        <a href="{{ route('issuesAdmin') }}" class="admin-nav-link active">
          <i class="fas fa-tasks mr-1"></i> Issues
        </a>

        
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="admin-logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            Sair
          </button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Conteúdo Principal -->
  <main class="admin-container">
    @yield('content')
  </main>

  @stack('scripts')
</body>
</html>