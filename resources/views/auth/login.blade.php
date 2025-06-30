@extends('layouts.app')

@section('content')
<div class="auth-center-row">
    <div class="auth-card">
        <div class="auth-card-header">Login</div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email" class="auth-form-label">Email</label>
            <input type="email" class="auth-form-input @error('email') is-invalid @enderror" id="email" name="email" required autofocus>
            @error('email')
                <span class="auth-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password" class="auth-form-label">Senha</label>
            <input type="password" class="auth-form-input @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <span class="auth-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="auth-btn-primary">Entrar</button>
        </form>
    </div>
</div>
@endsection