@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Mes offres de stage</h1>
        <a href="{{ route('company.offers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nouvelle offre
        </a>
    </div>
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>Titre</th>
                        <th>Lieu</th>
                        <th>Durée</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offers as $offer)
                        <tr>
                            <td>{{ $offer->title }}</td>
                            <td>{{ $offer->location }}</td>
                            <td>{{ $offer->duration }}</td>
                            <td>{{ $offer->start_date ? $offer->start_date->format('d/m/Y') : '-' }}</td>
                            <td>{{ $offer->end_date ? $offer->end_date->format('d/m/Y') : '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $offer->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($offer->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('company.offers.show', $offer) }}" class="btn btn-sm btn-outline-info" title="Voir"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('company.offers.edit', $offer) }}" class="btn btn-sm btn-outline-warning" title="Modifier"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('company.offers.destroy', $offer) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette offre ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucune offre publiée pour le moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">
        {{ $offers->links() }}
    </div>
</div>
@endsection
