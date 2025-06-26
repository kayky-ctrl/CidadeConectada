@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Meus Reports</h2>
    <a href="{{ route('issues.create') }}" class="btn btn-primary">Novo Report</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Localização</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($issues as $issue)
                <tr>
                    <td>{{ $issue->title }}</td>
                    <td>{{ $issue->location }}</td>
                    <td>{{ ucfirst($issue->category) }}</td>
                    <td>
                        <span class="badge bg-{{ $issue->status === 'resolved' ? 'success' : ($issue->status === 'pending' ? 'warning' : 'info') }}">
                            {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
                        </span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">Detalhes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection