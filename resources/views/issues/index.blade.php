@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-bold text-gray-800">Meus Reports</h1>
    <a href="{{ route('issues.create') }}" class="btn btn-primary flex items-center">
      <i class="fas fa-plus mr-2"></i> Novo Report
    </a>
  </div>

  <div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
      <table class="table w-full">
        <thead>
          <tr>
            <th class="px-6 py-3">Título</th>
            <th class="px-6 py-3">Localização</th>
            <th class="px-6 py-3">Categoria</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Ações</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($issues as $issue)
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4">{{ $issue->title }}</td>
            <td class="px-6 py-4">{{ $issue->location }}</td>
            <td class="px-6 py-4">
              <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                {{ ucfirst($issue->category) }}
              </span>
            </td>
            <td class="px-6 py-4">
              <span class="status-badge status-{{ $issue->status }}">
                {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
              </span>
            </td>
            <td class="px-6 py-4">
              @if($issue->status === 'resolved' && !$issue->ratings->where('user_id', auth()->id())->count())
              <a href="{{ route('ratings.create', $issue) }}" class="text-blue-600 hover:text-blue-800">
                Avaliar
              </a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection