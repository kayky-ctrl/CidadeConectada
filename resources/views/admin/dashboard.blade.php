@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">Dashboard Administrativo</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Bem-vindo, {{ auth()->user()->name }}!</h5>
            <p class="card-text">Você está no painel de controle da prefeitura.</p>
            <a href="{{ route('admin.issues') }}" class="btn btn-primary">
                Gerenciar Ocorrências
            </a>
        </div>
    </div>
</div>
@endsection