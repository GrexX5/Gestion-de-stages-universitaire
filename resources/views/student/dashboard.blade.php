@extends('layouts.app')

@section('title', 'Tableau de bord - Étudiant')

@section('content')
<div class="dashboard-container">
    <div class="welcome-banner">
        <h1>Bonjour, {{ Auth::user()->name }} 👋</h1>
        <p class="text-muted">Bienvenue sur votre espace étudiant. Suivez vos candidatures, découvrez des offres et restez informé.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-blue-100 text-blue-600"><i class="fas fa-file-alt"></i></div>
            <div class="stat-info">
                <h3>{{ $applicationsCount }}</h3>
                <p>Candidatures</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-green-100 text-green-600"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3>{{ $acceptedCount }}</h3>
                <p>Acceptées</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-yellow-100 text-yellow-600"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <h3>{{ $pendingCount }}</h3>
                <p>En attente</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-gray-100 text-gray-600"><i class="fas fa-briefcase"></i></div>
            <div class="stat-info">
                <h3>{{ $savedOffersCount }}</h3>
                <p>Offres sauvegardées</p>
            </div>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h2 class="card-title">Dernières candidatures</h2>
            <a href="#" class="btn btn-outline btn-sm">Voir tout</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Entreprise</th>
                        <th>Poste</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                        <tr>
                            <td>{{ $app->offer->company->name ?? '-' }}</td>
                            <td>{{ $app->offer->title ?? '-' }}</td>
                            <td>{{ $app->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($app->isAccepted())
                                    <span class="badge badge-success">Acceptée</span>
                                @elseif($app->isPending())
                                    <span class="badge badge-warning">En attente</span>
                                @elseif($app->isRejected())
                                    <span class="badge badge-danger">Refusée</span>
                                @else
                                    <span class="badge badge-secondary">{{ ucfirst($app->status) }}</span>
                                @endif
                            </td>
                            <td><a href="{{ route('applications.show', $app) }}" class="btn btn-sm btn-primary">Voir</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucune candidature récente.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h2 class="card-title">Offres recommandées</h2>
            <a href="#" class="btn btn-outline btn-sm">Voir plus</a>
        </div>
        <div class="offers-list d-flex gap-3">
            @forelse($recommendedOffers as $offer)
                <div class="offer-card">
                    <h3>{{ $offer->title }}</h3>
                    <p class="company-name">{{ $offer->company->name ?? '-' }} • {{ $offer->location }}</p>
                    <span class="badge badge-primary">{{ $offer->duration }}</span>
                    <a href="{{ route('company.offers.show', $offer) }}" class="btn btn-sm btn-outline">Voir l'offre</a>
                </div>
            @empty
                <div class="text-muted">Aucune offre recommandée pour le moment.</div>
            @endforelse
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Alertes & rappels</h2>
        </div>
        <div class="alerts-list">
            <div class="alert alert-info mb-2">
                <i class="fas fa-info-circle mr-2"></i> Convention de stage à signer avant le 30 juin.
            </div>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle mr-2"></i> Pensez à mettre à jour votre CV.
            </div>
        </div>
    </div>
    @include('components.footer')
</div>
@endsection

