@extends('layouts.app')

@section('content')
<div class="rating-container">
  <div class="rating-card">
    @if(session('success'))
      <div class="rating-success-message">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
      </div>
    @endif

    <div class="rating-header">
      <h1 class="rating-title">Avaliar Solução</h1>
      <p class="rating-subtitle">Avalie como foi resolvido o problema: <strong>{{ $issue->title }}</strong></p>
    </div>

    <form method="POST" action="{{ route('ratings.store', $issue) }}">
      @csrf
      
      <!-- Nota -->
      <div class="rating-form-group">
        <label class="rating-label">Qual sua avaliação?</label>
        <div class="rating-stars-container" id="stars-container">
          <i class="fas fa-star rating-star" data-rating="1"></i>
          <i class="fas fa-star rating-star" data-rating="2"></i>
          <i class="fas fa-star rating-star" data-rating="3"></i>
          <i class="fas fa-star rating-star" data-rating="4"></i>
          <i class="fas fa-star rating-star" data-rating="5"></i>
        </div>
        <input type="hidden" name="rating" id="rating-value" value="{{ old('rating', 0) }}" required>
        @error('rating')
          <span class="rating-error">{{ $message }}</span>
        @enderror
      </div>
      
      <!-- Comentário -->
      <div class="rating-form-group">
        <label for="comment" class="rating-label">Comentário (opcional)</label>
        <textarea id="comment" name="comment" class="rating-textarea" 
                  placeholder="Conte como foi sua experiência">{{ old('comment') }}</textarea>
        @error('comment')
          <span class="rating-error">{{ $message }}</span>
        @enderror
      </div>
      
      <!-- Botões -->
      <div class="rating-actions">
        <a href="{{ url()->previous() }}" class="rating-btn rating-btn-secondary">
          Cancelar
        </a>
        <button type="submit" class="rating-btn rating-btn-primary">
          Enviar Avaliação
        </button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
  // Seleção de estrelas
  const stars = document.querySelectorAll('.rating-star');
  const ratingValue = document.getElementById('rating-value');
  
  stars.forEach(star => {
    star.addEventListener('click', () => {
      const rating = parseInt(star.getAttribute('data-rating'));
      ratingValue.value = rating;
      
      stars.forEach((s, index) => {
        if (index < rating) {
          s.classList.add('active');
        } else {
          s.classList.remove('active');
        }
      });
    });
    
    // Pré-selecionar estrelas se houver valor antigo
    if (parseInt(ratingValue.value) >= parseInt(star.getAttribute('data-rating'))) {
      star.classList.add('active');
    }
  });
</script>
@endpush
@endsection