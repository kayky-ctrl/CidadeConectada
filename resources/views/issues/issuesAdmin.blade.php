@extends('layouts.app')

@section('content')
    <div class="issues-table-container">
        <div class="issues-table-header">
            <h2>Painel Administrativo - Issues</h2>
        </div>
        <table class="issues-table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Usuário</th>
                    <th>Localização</th>
                    <th>Status</th>
                    <th>Avaliações</th>
                    <th>Atualizações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($issues as $issue)
                    <tr>
                        <td>{{ $issue->title }}</td>
                        <td>
                            <div class="user-info">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($issue->user->name ?? 'U') }}&background=007bff&color=fff"
                                    class="user-avatar" alt="Avatar">
                                {{ $issue->user->name ?? 'Usuário não encontrado' }}
                            </div>
                            @if ($issue->photo)
                                <div class="issue-photo-preview">
                                    <img src="{{ asset('storage/' . $issue->photo) }}" alt="Foto do Reporte"
                                        class="issue-photo-img">
                                </div>
                            @endif
                        </td>
                        <td>{{ $issue->location }}</td>
                        <td>
                            <span class="status-badge status-{{ $issue->status }}">
                                {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
                            </span>
                            <form action="{{ route('issuesAdmin.update-status', $issue) }}" method="POST"
                                style="display:inline; margin-top:0.5rem;">
                                @csrf
                                <select name="status" class="status-select" onchange="this.form.submit()">
                                    @foreach (['pending', 'in_progress', 'resolved', 'rejected'] as $status)
                                        <option value="{{ $status }}"
                                            {{ $issue->status === $status ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="comments" value="Status alterado via painel admin">
                            </form>
                        </td>
                        <td>
                            @if ($issue->ratings->count())
                                <div>
                                    <strong>Média:</strong>
                                    {{ number_format($issue->ratings->avg('rating'), 1) }} ⭐
                                </div>
                                <ul style="margin:0;padding-left:1em;">
                                    @foreach ($issue->ratings as $rating)
                                        <li>
                                            <span
                                                style="color:#007bff;font-weight:600;">{{ $rating->user->name ?? 'Usuário' }}</span>:
                                            {{ $rating->rating }} ⭐
                                            @if ($rating->comment)
                                                <br><span style="color:#888;">"{{ $rating->comment }}"</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">Sem avaliações</span>
                            @endif
                        </td>
                        
                        </td>
                        <td>
                            <button type="button" class="btn-status" onclick="openModal({{ $issue->id }})">
                                Ver ({{ $issue->updates->count() }})
                            </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($issues as $issue)
        <div class="modal" id="modal-{{ $issue->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title">Atualizações - {{ $issue->title }}</span>
                    <button class="btn-close" onclick="closeModal({{ $issue->id }})">&times;</button>
                </div>
                <ul class="list-group">
                    @forelse ($issue->updates as $update)
                        <li class="list-group-item">
                            <strong>{{ $update->created_at->format('d/m/Y H:i') }}</strong>:
                            {{ $update->comments }}
                            <br>
                            <small class="text-muted">Por: {{ $update->admin->name ?? 'Admin' }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Nenhuma atualização ainda.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    @endforeach


    @push('scripts')
        <script>
            function openModal(id) {
                document.getElementById('modal-' + id).classList.add('active');
            }

            function closeModal(id) {
                document.getElementById('modal-' + id).classList.remove('active');
            }
        </script>
    @endpush
@endsection
