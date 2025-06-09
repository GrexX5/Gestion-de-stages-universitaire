@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Candidatures reçues</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Offre</th>
                    <th>Date de soumission</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $app)
                    <tr>
                        <td>{{ $app->student->user->name ?? '-' }}</td>
                        <td>{{ $app->offer->title ?? '-' }}</td>
                        <td>{{ $app->created_at->format('d/m/Y') }}</td>
                        <td><span class="badge badge-{{ $app->status === 'pending' ? 'warning' : ($app->status === 'accepted' ? 'success' : 'danger') }}">{{ ucfirst($app->status) }}</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">Voir</a>
                            @if($app->status === 'pending')
                                <a href="#" class="btn btn-sm btn-success mr-1">Accepter</a>
                                <a href="#" class="btn btn-sm btn-danger">Refuser</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucune candidature reçue.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $applications->links() }}
        </div>
    </div>
@endsection
