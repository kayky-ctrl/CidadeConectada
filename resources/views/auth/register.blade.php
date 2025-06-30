@extends('layouts.app')

@section('content')
<div class="auth-center-row">
    <div class="auth-card">
        <div class="auth-card-header">{{ __('Cadastro') }}</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name" class="auth-form-label">{{ __('Nome Completo') }}</label>
            <input id="name" type="text" class="auth-form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="auth-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="email" class="auth-form-label">{{ __('E-mail') }}</label>
            <input id="email" type="email" class="auth-form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="auth-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password" class="auth-form-label">{{ __('Senha') }}</label>
            <input id="password" type="password" class="auth-form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="auth-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password-confirm" class="auth-form-label">{{ __('Confirmar Senha') }}</label>
            <input id="password-confirm" type="password" class="auth-form-input" name="password_confirmation" required autocomplete="new-password">

            <label for="phone" class="auth-form-label">{{ __('Telefone') }}</label>
            <input id="phone" type="text" class="auth-form-input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <span class="auth-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="address" class="auth-form-label">{{ __('Endereço') }}</label>
            <input id="address" type="text" class="auth-form-input @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
            @error('address')
                <span class="auth-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="auth-btn-primary">
                {{ __('Cadastrar') }}
            </button>
        </form>
    </div>
</div>
@endsection