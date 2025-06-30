@extends('layouts.app')

@section('content')
    <div class="issues-table-container">
        <div class="issues-table-header">
            <h2>Meus Reports</h2>
            <a href="{{ route('issues.create') }}" class="home-btn home-btn-primary">+ Novo Report</a>
        </div>
        <table class="issues-table">
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
                @foreach ($issues as $issue)
                    <tr>
                        <td>{{ $issue->title }}</td>
                        <td>{{ $issue->location }}</td>
                        <td>
                            <span class="category-badge category-{{ $issue->category }}">
                                {{ ucfirst($issue->category) }}
                            </span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $issue->status }}">
                                {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
                            </span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $issue->status }}">
                                {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
                            </span>
                            @if ($issue->status === 'resolved' && !$issue->ratings->where('user_id', auth()->id())->count())
                                <a href="{{ route('ratings.create', $issue) }}" class="table-btn table-btn-info">Avaliar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
