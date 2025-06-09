@extends('layouts.app')

@section('title', 'Tableau de bord - Entreprise')

@section('content')
<div class="dashboard-container">
    <div class="welcome-banner">
        <h1>Bonjour, {{ Auth::user()->name }} 👋</h1>
        <p class="text-muted">Bienvenue sur votre espace entreprise. Gérez vos offres et suivez les candidatures reçues.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-blue-100 text-blue-600"><i class="fas fa-briefcase"></i></div>
            <div class="stat-info">
                <h3>{{ $offersCount }}</h3>
                <p>Offres publiées</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-green-100 text-green-600"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <h3>{{ $applicationsCount }}</h3>
                <p>Candidatures reçues</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-yellow-100 text-yellow-600"><i class="fas fa-user-check"></i></div>
            <div class="stat-info">
                <h3>{{ $positionsFilled }}</h3>
                <p>Stages pourvus</p>
            </div>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h2 class="card-title">Mes offres de stage</h2>
            <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle mr-1"></i>Nouvelle offre</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Lieu</th>
                        <th>Statut</th>
                        <th>Date publication</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offers as $offer)
                        <tr>
                            <td>{{ $offer->title }}</td>
                            <td>{{ $offer->location }}</td>
                            <td><span class="badge badge-{{ $offer->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($offer->status) }}</span></td>
                            <td>{{ $offer->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('company.offers.show', $offer) }}" class="btn btn-sm btn-outline-primary mr-1">Voir</a>
                                <a href="{{ route('company.offers.edit', $offer) }}" class="btn btn-sm btn-outline-secondary">Modifier</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucune offre publiée récemment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Candidatures reçues</h2>
        </div>
        <div class="applications-list">
            @forelse($recentApplications as $app)
                <div class="application-item d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <strong>{{ $app->student->user->name ?? '-' }}</strong> - {{ $app->offer->title ?? '-' }}
                        <span class="badge badge-{{ $app->status === 'pending' ? 'info' : ($app->status === 'accepted' ? 'success' : 'danger') }} ml-2">{{ ucfirst($app->status) }}</span>
                    </div>
                    <div>
                        @if($app->status === 'pending')
                            <a href="#" class="btn btn-sm btn-success mr-1">Accepter</a>
                            <a href="#" class="btn btn-sm btn-danger">Refuser</a>
                        @else
                            <a href="#" class="btn btn-sm btn-outline-primary">Détails</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-muted">Aucune candidature récente.</div>
            @endforelse
        </div>
    </div>
    @include('components.footer')
</div>
@endsection

