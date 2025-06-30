@extends('layouts.app')

@section('content')
<div class="register-container">
  <div class="register-card">
    <div class="register-header">
      <h1 class="register-title">Crie sua conta</h1>
      <p class="register-subtitle">Junte-se à nossa comunidade</p>
    </div>
    
    <div class="register-body">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="register-grid">
          <!-- Nome Completo -->
          <div class="register-form-group register-full-width">
            <label for="name" class="register-label">Nome Completo</label>
            <div class="register-input-icon">
              <i class="fas fa-user"></i>
              <input id="name" type="text" class="register-input @error('name') error @enderror" 
                     name="name" value="{{ old('name') }}" required autocomplete="name" 
                     placeholder="Seu nome completo" autofocus>
            </div>
            @error('name')
              <span class="register-error">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- Email -->
          <div class="register-form-group">
            <label for="email" class="register-label">E-mail</label>
            <div class="register-input-icon">
              <i class="fas fa-envelope"></i>
              <input id="email" type="email" class="register-input @error('email') error @enderror" 
                     name="email" value="{{ old('email') }}" required autocomplete="email"
                     placeholder="seu@email.com">
            </div>
            @error('email')
              <span class="register-error">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- Telefone -->
          <div class="register-form-group">
            <label for="phone" class="register-label">Telefone</label>
            <div class="register-input-icon">
              <i class="fas fa-phone"></i>
              <input id="phone" type="tel" class="register-input @error('phone') error @enderror" 
                     name="phone" value="{{ old('phone') }}" required
                     placeholder="(00) 00000-0000">
            </div>
            @error('phone')
              <span class="register-error">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- Senha -->
          <div class="register-form-group">
            <label for="password" class="register-label">Senha</label>
            <div class="register-input-icon">
              <i class="fas fa-lock"></i>
              <input id="password" type="password" class="register-input @error('password') error @enderror" 
                     name="password" required autocomplete="new-password"
                     placeholder="Mínimo 8 caracteres">
            </div>
            @error('password')
              <span class="register-error">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- Confirmar Senha -->
          <div class="register-form-group">
            <label for="password-confirm" class="register-label">Confirmar Senha</label>
            <div class="register-input-icon">
              <i class="fas fa-lock"></i>
              <input id="password-confirm" type="password" class="register-input" 
                     name="password_confirmation" required autocomplete="new-password"
                     placeholder="Confirme sua senha">
            </div>
          </div>
          
          <!-- Endereço -->
          <div class="register-form-group register-full-width">
            <label for="address" class="register-label">Endereço</label>
            <div class="register-input-icon">
              <i class="fas fa-map-marker-alt"></i>
              <input id="address" type="text" class="register-input @error('address') error @enderror" 
                     name="address" value="{{ old('address') }}" required
                     placeholder="Rua, número, bairro">
            </div>
            @error('address')
              <span class="register-error">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- Foto (Opcional) -->
          <div class="register-form-group register-full-width">
            <label for="photo" class="register-label">Foto (Opcional)</label>
            <input type="file" id="photo" name="photo" accept="image/*"
                   class="register-file-input @error('photo') error @enderror">
            @error('photo')
              <span class="register-error">{{ $message }}</span>
            @enderror
          </div>
        </div>
        
        <!-- Botão de Registro -->
        <button type="submit" class="register-btn register-btn-primary mt-4">
          Criar Conta
        </button>
      </form>
      
      <div class="register-footer">
        Já tem uma conta? 
        <a href="{{ route('login') }}" class="register-link">Faça login</a>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
// Máscara para telefone
document.getElementById('phone').addEventListener('input', function(e) {
  var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
  e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
});
</script>
@endpush
@endsection