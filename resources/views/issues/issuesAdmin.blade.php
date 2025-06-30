@extends('layouts.admin')

@section('content')
<div class="admin-header">
  <h1 class="admin-title">Gerenciamento de Issues</h1>
</div>

<div class="admin-card">
  <div class="overflow-x-auto">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Título</th>
          <th>Usuário</th>
          <th>Localização</th>
          <th>Status</th>
          <th>Avaliações</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($issues as $issue)
        <tr>
          <td>{{ $issue->title }}</td>
          <td>{{ $issue->user->name ?? 'N/A' }}</td>
          <td>{{ $issue->location }}</td>
          <td>
            <form action="{{ route('issuesAdmin.update-status', $issue) }}" method="POST">
              @csrf
              <span class="status-badge status-{{ $issue->status }}">
                {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
              </span>
              <select name="status" class="status-select mt-1" onchange="this.form.submit()">
                @foreach(['pending', 'in_progress', 'resolved', 'rejected'] as $status)
                  <option value="{{ $status }}" {{ $issue->status === $status ? 'selected' : '' }}>
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                  </option>
                @endforeach
              </select>
            </form>
          </td>
          <td>
            @if($issue->ratings->count())
              <div class="flex items-center">
                <span class="rating-stars">
                  @for($i = 0; $i < round($issue->ratings->avg('rating')); $i++)
                    ★
                  @endfor
                </span>
                <span>{{ number_format($issue->ratings->avg('rating'), 1) }}/5</span>
              </div>
            @else
              <span class="text-gray-400">Sem avaliações</span>
            @endif
          </td>
          <td>
            <button onclick="openModal('modal-{{ $issue->id }}')" 
                    class="text-primary hover:underline">
              Detalhes
            </button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@foreach($issues as $issue)
<!-- Modal Expandido -->
<div id="modal-{{ $issue->id }}" class="admin-modal">
  <div class="admin-modal-content admin-modal-expanded">
    <div class="admin-modal-header">
      <h3 class="admin-modal-title">Detalhes do Issue: {{ $issue->title }}</h3>
      <button class="admin-modal-close" onclick="closeModal('modal-{{ $issue->id }}')">
        &times;
      </button>
    </div>
    <div class="admin-modal-body">
      <div class="issue-meta">
        <div class="issue-meta-item">
          <div class="issue-meta-label">Usuário</div>
          <div class="issue-meta-value">{{ $issue->user->name ?? 'N/A' }}</div>
        </div>
        <div class="issue-meta-item">
          <div class="issue-meta-label">Localização</div>
          <div class="issue-meta-value">{{ $issue->location }}</div>
        </div>
        <div class="issue-meta-item">
          <div class="issue-meta-label">Categoria</div>
          <div class="issue-meta-value">{{ ucfirst($issue->category) }}</div>
        </div>
        <div class="issue-meta-item">
          <div class="issue-meta-label">Status</div>
          <div class="issue-meta-value">
            <span class="status-badge status-{{ $issue->status }}">
              {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
            </span>
          </div>
        </div>
      </div>

      <h4 class="font-medium text-gray-700 mb-2">Descrição do Problema:</h4>
      <div class="issue-description">
        {{ $issue->description }}
      </div>

      @if($issue->photo)
      <div class="issue-photo-container">
        <h4 class="font-medium text-gray-700 mb-2">Foto do Problema:</h4>
        <img src="{{ asset('storage/' . $issue->photo) }}" alt="Foto do problema" class="issue-photo">
      </div>
      @endif

      <h4 class="font-medium text-gray-700 mt-6 mb-2">Atualizações:</h4>
      @forelse($issue->updates as $update)
        <div class="update-item">
          <div class="update-date">
            {{ $update->created_at->format('d/m/Y H:i') }}
          </div>
          <div class="update-content">
            {{ $update->comments }}
          </div>
          <div class="update-author">
            Por: {{ $update->admin->name ?? 'Administrador' }}
          </div>
        </div>
      @empty
        <div class="text-center py-4 text-gray-500">
          Nenhuma atualização registrada para este issue.
        </div>
      @endforelse
    </div>
  </div>
</div>
@endforeach

@push('scripts')
<script>
  function openModal(id) {
    document.getElementById(id).classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(id) {
    document.getElementById(id).classList.remove('active');
    document.body.style.overflow = 'auto';
  }

  window.onclick = function(event) {
    if (event.target.classList.contains('admin-modal')) {
      event.target.classList.remove('active');
      document.body.style.overflow = 'auto';
    }
  }
</script>
@endpush
@endsection