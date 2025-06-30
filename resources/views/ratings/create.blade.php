@extends('layouts.app')

@section('content')
<div class="auth-center-row">
    <div class="auth-card">
        <div class="auth-card-header">Avaliar Solução</div>
        <form method="POST" action="{{ route('ratings.store', $issue) }}">
            @csrf
            <label for="rating" class="auth-form-label">Nota (1 a 5)</label>
            <select id="rating" name="rating" class="auth-form-input" required>
                <option value="">Selecione</option>
                @for($i=1;$i<=5;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <label for="comment" class="auth-form-label">Comentário (opcional)</label>
            <textarea id="comment" name="comment" class="auth-form-input" rows="3"></textarea>
            <button type="submit" class="auth-btn-primary">Enviar Avaliação</button>
        </form>
    </div>
</div>
@endsection