@extends('layouts.app')

@section('content')
<div class="login-container">
  <div class="login-card">
    <div class="login-header">
      <h1 class="login-title">Bem-vindo de volta</h1>
      <p class="login-subtitle">Acesse sua conta para continuar</p>
    </div>
    
    <div class="login-body">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <!-- Email -->
        <div class="login-form-group login-input-icon">
          <i class="fas fa-envelope"></i>
          <input id="email" type="email" class="login-input @error('email') error @enderror" 
                 name="email" value="{{ old('email') }}" required autocomplete="email" 
                 placeholder="Seu e-mail" autofocus>
          @error('email')
            <span class="login-error">{{ $message }}</span>
          @enderror
        </div>
        
        <!-- Senha -->
        <div class="login-form-group login-input-icon">
          <i class="fas fa-lock"></i>
          <input id="password" type="password" class="login-input @error('password') error @enderror" 
                 name="password" required autocomplete="current-password" 
                 placeholder="Sua senha">
          @error('password')
            <span class="login-error">{{ $message }}</span>
          @enderror
        </div>
        
        <!-- Opções -->
        <div class="login-options">
          <label class="login-remember">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            Lembrar de mim
          </label>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="login-forgot">
              Esqueceu a senha?
            </a>
          @endif
        </div>
        
        <!-- Botão -->
        <button type="submit" class="login-btn login-btn-primary">
          Entrar
        </button>
      </form>
      
      <div class="login-footer">
        Não tem uma conta? 
        <a href="{{ route('register') }}" class="login-link">Cadastre-se</a>
      </div>
    </div>
  </div>
</div>
@endsection