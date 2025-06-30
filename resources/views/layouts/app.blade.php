<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CityConnect - {{ $title ?? 'Plataforma Colaborativa' }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/app-custom.css') }}">
  @stack('styles')
</head>
<body>
    @php 
        // Defina os e-mails (ou IDs) dos administradores aqui
        $admins = ['admin@example.com'];
    @endphp
  <!-- Navbar Global -->
  <nav class="global-navbar">
    <div class="navbar-container">
      <a href="{{ route('home') }}" class="navbar-brand">
        <span class="navbar-brand-text">CityConnect</span>
      </a>

      <button class="mobile-menu-button" id="mobileMenuButton">
        <i class="fas fa-bars"></i>
      </button>

      <div class="navbar-menu" id="navbarMenu">
        <a href="{{ route('issues.index') }}" class="navbar-link {{ request()->routeIs('issues.*') ? 'active' : '' }}">
          <i class="fas fa-list-check"></i>
          <span>Meus Reports</span>
        </a>
        
        @auth
          @if(in_array(auth()->user()->email, $admins))
            <a href="{{ route('issuesAdmin') }}" class="navbar-link {{ request()->routeIs('issuesAdmin') ? 'active' : '' }}">
              <i class="fas fa-tools"></i>
              <span>Painel Admin</span>
            </a>
          @endif

          <div class="navbar-user">
            <span class="user-greeting">
              <i class="fas fa-user-circle"></i>
              {{ auth()->user()->name }}
            </span>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="navbar-button navbar-button-secondary">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sair</span>
              </button>
            </form>
          </div>
        @else
          <a href="{{ route('login') }}" class="navbar-button navbar-button-secondary">
            <i class="fas fa-sign-in-alt"></i>
            <span>Entrar</span>
          </a>
          <a href="{{ route('register') }}" class="navbar-button navbar-button-primary">
            <i class="fas fa-user-plus"></i>
            <span>Cadastre-se</span>
          </a>
        @endauth
      </div>
    </div>
  </nav>

  <!-- Conteúdo Principal -->
  <main class="main-content" style="padding-top: 70px; min-height: calc(100vh - 70px - 120px);">
    @yield('content')
  </main>

  <!-- Footer Global -->
  <footer class="global-footer">
    <div class="footer-container">
      <div class="footer-grid">
        <div class="footer-column">
          <h3 class="footer-column-title">CityConnect</h3>
          <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 1rem;">
            Conectando cidadãos e gestão pública para construir cidades melhores.
          </p>
          <div class="footer-social">
            <a href="https://www.instagram.com/ntkayky/" class="footer-social-link"><i class="fab fa-instagram"></i></a>
            <a href="#" class="footer-social-link"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>

        <div class="footer-column">
          <h3 class="footer-column-title">Contato</h3>
          <ul class="footer-links">
            <li class="footer-link"><a href="#"><i class="fas fa-envelope mr-2"></i> kaykyrdepaula@gmail.com</a></li>
            <li class="footer-link"><a href="#"><i class="fas fa-phone mr-2"></i> (14) 99845-2510</a></li>
            <li class="footer-link"><a href="#"><i class="fas fa-map-marker-alt mr-2"></i> Prefeitura Municipal</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} CityConnect. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>

  @stack('scripts')
  <script>
    // Menu Mobile
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const navbarMenu = document.getElementById('navbarMenu');

    mobileMenuButton.addEventListener('click', () => {
      navbarMenu.classList.toggle('active');
      mobileMenuButton.innerHTML = navbarMenu.classList.contains('active') 
        ? '<i class="fas fa-times"></i>' 
        : '<i class="fas fa-bars"></i>';
    });
  </script>
</body>
</html>