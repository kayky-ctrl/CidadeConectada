@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bem-vindo ao Sistema de Manutenção Urbana') }}</div>

                <div class="card-body">
                    @auth
                        <p>Olá, {{ auth()->user()->name }}!</p>
                        <a href="{{ route('issues.index') }}" class="btn btn-primary">
                            Ver meus reports
                        </a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.issues') }}" class="btn btn-secondary ms-2">
                                Painel Administrativo
                            </a>
                        @endif
                    @else
                        <p>Faça login para reportar problemas urbanos</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                {{ __('Login') }}
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                {{ __('Cadastre-se') }}
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection