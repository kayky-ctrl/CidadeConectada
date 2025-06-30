@extends('layouts.app')

@section('content')
@php
    $admins = ['admin@example.com'];
@endphp

<div class="home-flex-center">
    <div class="home-card">
        <div class="home-row">
            <div class="home-col-img">
                <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Cidadão" class="home-img">
                <h2 class="home-title">Bem-vindo!</h2>
                <p class="home-lead">Sua voz faz a cidade melhor.</p>
            </div>
            <div class="home-col-content">
                @auth
                    <div class="home-greeting">
                        <h3>Olá, {{ auth()->user()->name }}!</h3>
                        <p class="home-muted">Acompanhe e reporte problemas urbanos facilmente.</p>
                    </div>
                    <div class="home-btns">
                        <a href="{{ route('issues.index') }}" class="home-btn home-btn-primary">
                            📋 Ver meus reports
                        </a>

                        @if(in_array(auth()->user()->email, $admins))
                            <a href="{{ route('issuesAdmin') }}" class="home-btn home-btn-secondary">
                                🛠️ Painel Administrativo
                            </a>
                        @endif
                    </div>
                @else
                    <div class="home-greeting">
                        <h3>Participe da transformação!</h3>
                        <p class="home-muted">Faça login para reportar problemas urbanos e acompanhar suas solicitações.</p>
                    </div>
                    <div class="home-btns">
                        <a href="{{ route('login') }}" class="home-btn home-btn-primary">
                            🔑 Login
                        </a>
                        <a href="{{ route('register') }}" class="home-btn home-btn-secondary">
                            📝 Cadastre-se
                        </a>
                    </div>
                @endauth
            </div>
        </div>
        <div class="home-tip">
            <span>💡 Dica: quanto mais cidadãos participam, mais eficiente é a manutenção da cidade!</span>
        </div>
    </div>
</div>
@push('styles')

@endpush