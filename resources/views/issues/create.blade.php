@extends('layouts.app')

@section('content')
<div class="report-center-row">
    <div class="report-card">
        <div class="report-card-header">Reportar Novo Problema</div>
        <form method="POST" action="{{ route('issues.store') }}" enctype="multipart/form-data">
            @csrf

            <label for="title" class="report-form-label">Título</label>
            <input type="text" class="report-form-input @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <span class="report-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="description" class="report-form-label">Descrição</label>
            <textarea class="report-form-input @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            @error('description')
                <span class="report-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="location" class="report-form-label">Localização</label>
            <input type="text" class="report-form-input @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required>
            @error('location')
                <span class="report-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="category" class="report-form-label">Categoria</label>
            <select class="report-form-input @error('category') is-invalid @enderror" id="category" name="category" required>
                <option value="">Selecione uma categoria</option>
                <option value="buraco" {{ old('category') == 'buraco' ? 'selected' : '' }}>Buraco na rua</option>
                <option value="iluminacao" {{ old('category') == 'iluminacao' ? 'selected' : '' }}>Iluminação pública</option>
                <option value="calcada" {{ old('category') == 'calcada' ? 'selected' : '' }}>Calçada danificada</option>
                <option value="lixo" {{ old('category') == 'lixo' ? 'selected' : '' }}>Acúmulo de lixo</option>
                <option value="outros" {{ old('category') == 'outros' ? 'selected' : '' }}>Outros</option>
            </select>
            @error('category')
                <span class="report-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="photo" class="report-form-label">Foto (Opcional)</label>
            <input class="report-form-input @error('photo') is-invalid @enderror" type="file" id="photo" name="photo" accept="image/*">
            @error('photo')
                <span class="report-invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="report-btns">
                <button type="submit" class="report-btn-primary">Enviar Reporte</button>
                <a href="{{ route('issues.index') }}" class="report-btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection