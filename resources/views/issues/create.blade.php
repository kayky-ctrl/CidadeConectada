@extends('layouts.app')

@section('content')
<div class="issue-form-container">
  <div class="issue-form-card fade-in">
    <h1 class="issue-form-title">Reportar Novo Problema</h1>
    
    <form method="POST" action="{{ route('issues.store') }}" enctype="multipart/form-data">
      @csrf
      
      <div class="issue-form-grid">
        <!-- Título -->
        <div class="issue-form-group issue-form-full-width">
          <label for="title" class="issue-form-label">Título</label>
          <input type="text" id="title" name="title" value="{{ old('title') }}"
                 class="issue-form-input @error('title') border-red-500 @enderror" required>
          @error('title')
            <p class="issue-form-error">{{ $message }}</p>
          @enderror
        </div>

        <!-- Descrição -->
        <div class="issue-form-group issue-form-full-width">
          <label for="description" class="issue-form-label">Descrição</label>
          <textarea id="description" name="description" 
                    class="issue-form-input issue-form-textarea @error('description') border-red-500 @enderror" required>{{ old('description') }}</textarea>
          @error('description')
            <p class="issue-form-error">{{ $message }}</p>
          @enderror
        </div>

        <!-- Localização -->
        <div class="issue-form-group">
          <label for="location" class="issue-form-label">Localização</label>
          <input type="text" id="location" name="location" value="{{ old('location') }}"
                 class="issue-form-input @error('location') border-red-500 @enderror" required>
          @error('location')
            <p class="issue-form-error">{{ $message }}</p>
          @enderror
        </div>

        <!-- Categoria -->
        <div class="issue-form-group">
          <label for="category" class="issue-form-label">Categoria</label>
          <select id="category" name="category" 
                  class="issue-form-input issue-form-select @error('category') border-red-500 @enderror" required>
            <option value="">Selecione uma categoria</option>
            <option value="buraco" {{ old('category') == 'buraco' ? 'selected' : '' }}>Buraco na rua</option>
            <option value="iluminacao" {{ old('category') == 'iluminacao' ? 'selected' : '' }}>Iluminação pública</option>
            <option value="calcada" {{ old('category') == 'calcada' ? 'selected' : '' }}>Calçada danificada</option>
            <option value="lixo" {{ old('category') == 'lixo' ? 'selected' : '' }}>Acúmulo de lixo</option>
            <option value="outros" {{ old('category') == 'outros' ? 'selected' : '' }}>Outros</option>
          </select>
          @error('category')
            <p class="issue-form-error">{{ $message }}</p>
          @enderror
        </div>

        <!-- Foto -->
        <div class="issue-form-group issue-form-full-width">
          <label for="photo" class="issue-form-label">Foto (Opcional)</label>
          <input type="file" id="photo" name="photo" accept="image/*"
                 class="issue-form-file-input @error('photo') border-red-500 @enderror">
          @error('photo')
            <p class="issue-form-error">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <!-- Botões -->
      <div class="issue-form-actions">
        <a href="{{ route('issues.index') }}" class="btn btn-secondary">
          Cancelar
        </a>
        <button type="submit" class="btn btn-primary">
          Enviar Reporte
        </button>
      </div>
    </form>
  </div>
</div>
@endsection