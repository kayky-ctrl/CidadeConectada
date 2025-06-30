@extends('layouts.app')

@section('content')

@php
    // Defina os e-mails (ou IDs) dos administradores aqui
    $admins = ['admin@example.com'];
@endphp

<div class="home-flex-center">
    <div class="home-card">
        <div class="home-row">
            <div class="home-col-img">
                <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Cidadão" class="home-img">
                <h2 class="home-title">Sua voz transforma a cidade</h2>
                <p class="home-lead">
                    Conectamos cidadãos e gestão pública para resolver problemas urbanos de forma colaborativa
                </p>
            </div>
            <div class="home-col-content">
                @auth
                    <div class="home-greeting">
                        <h3>Olá, {{ auth()->user()->name }}!</h3>
                        <p class="home-muted">Acompanhe e reporte problemas urbanos de forma fácil e eficiente.</p>
                    </div>
                    <div class="home-btns">
                        <a href="{{ route('issues.index') }}" class="home-btn home-btn-primary">
                            <i class="fas fa-list-check"></i> Ver meus reports
                        </a>

                        @if(in_array(auth()->user()->email, $admins))
                            <a href="{{ route('issuesAdmin') }}" class="home-btn home-btn-secondary">
                                <i class="fas fa-tools"></i> Painel Administrativo
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
                            <i class="fas fa-sign-in-alt"></i> Entrar
                        </a>
                        <a href="{{ route('register') }}" class="home-btn home-btn-secondary">
                            <i class="fas fa-user-plus"></i> Cadastre-se
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

<div class="container py-12">
    <div class="features-grid grid md:grid-cols-3 gap-8">
        <div class="feature-card hover-scale">
            <div class="feature-icon text-blue-500 text-4xl mb-4">
                <i class="fas fa-bullhorn"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Reporte Problemas</h3>
            <p class="text-gray-600">Identifique e reporte problemas urbanos em sua comunidade com facilidade.</p>
        </div>
        
        <div class="feature-card hover-scale">
            <div class="feature-icon text-blue-500 text-4xl mb-4">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Localização Precisa</h3>
            <p class="text-gray-600">Nossa ferramenta permite marcar a localização exata do problema.</p>
        </div>
        
        <div class="feature-card hover-scale">
            <div class="feature-icon text-blue-500 text-4xl mb-4">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Acompanhamento</h3>
            <p class="text-gray-600">Acompanhe o status de todos os seus reports em tempo real.</p>
        </div>
    </div>
    
    <div class="tip-box bg-blue-50 border border-blue-100 rounded-lg p-6 max-w-2xl mx-auto mt-12 text-center">
        <p class="text-blue-600 font-medium ">
            <i class="fas fa-lightbulb mr-2"></i> Dica: Quanto mais cidadãos participam, mais eficiente é a manutenção da cidade!
        </p>
    </div>
</div>
@endsection