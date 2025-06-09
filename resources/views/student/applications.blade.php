@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Mes candidatures</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Offre</th>
                    <th>Entreprise</th>
                    <th>Date de soumission</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $app)
                    <tr>
                        <td>{{ $app->offer->title ?? '-' }}</td>
                        <td>{{ $app->offer->company->name ?? '-' }}</td>
                        <td>{{ $app->created_at->format('d/m/Y') }}</td>
                        <td><span class="badge badge-{{ $app->status === 'pending' ? 'warning' : ($app->status === 'accepted' ? 'success' : ($app->status === 'rejected' ? 'danger' : 'secondary')) }}">{{ ucfirst($app->status) }}</span></td>
                        <td><a href="#" class="btn btn-sm btn-outline-primary">Voir</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucune candidature enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $applications->links() }}
        </div>
    </div>
@endsection
