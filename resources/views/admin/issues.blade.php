@extends('layouts.app')

@section('content')
<h2 class="mb-4">Painel Administrativo - Issues</h2>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Usuário</th>
                <th>Localização</th>
                <th>Status</th>
                <th>Atualizações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($issues as $issue)
                <tr>
                    <td>{{ $issue->title }}</td>
                    <td>{{ $issue->user->name }}</td>
                    <td>{{ $issue->location }}</td>
                    <td>
                        <form action="{{ route('admin.issues.update-status', $issue) }}" method="POST" class="d-inline">
                            @csrf
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                @foreach(['pending', 'in_progress', 'resolved', 'rejected'] as $status)
                                    <option value="{{ $status }}" {{ $issue->status === $status ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="comments" value="Status alterado via painel admin">
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#updatesModal{{ $issue->id }}">
                            Ver ({{ $issue->updates->count() }})
                        </button>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
                    </td>
                </tr>
                
                <!-- Modal para atualizações -->
                <div class="modal fade" id="updatesModal{{ $issue->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Atualizações - {{ $issue->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    @foreach($issue->updates as $update)
                                        <li class="list-group-item">
                                            <strong>{{ $update->created_at->format('d/m/Y H:i') }}</strong>:
                                            {{ $update->comments }}
                                            <br>
                                            <small class="text-muted">Por: {{ $update->admin->name }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection