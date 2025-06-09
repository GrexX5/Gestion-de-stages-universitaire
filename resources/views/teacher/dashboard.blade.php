@extends('layouts.app')

@section('title', 'Tableau de bord - Enseignant')

@section('content')
<div class="dashboard-container">
    <div class="welcome-banner">
        <h1>Bonjour, {{ Auth::user()->name }} 👋</h1>
        <p class="text-muted">Bienvenue sur votre espace enseignant. Gérez les conventions de stage et suivez les étudiants encadrés.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-blue-100 text-blue-600"><i class="fas fa-file-signature"></i></div>
            <div class="stat-info">
                <h3>{{ $pendingCount }}</h3>
                <p>Conventions à valider</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-green-100 text-green-600"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3>{{ $validatedCount }}</h3>
                <p>Conventions validées</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-gray-100 text-gray-600"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <h3>{{ $studentsCount }}</h3>
                <p>Étudiants encadrés</p>
            </div>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h2 class="card-title">Conventions à valider</h2>
            <a href="#" class="btn btn-outline btn-sm">Voir tout</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Étudiant</th>
                        <th>Entreprise</th>
                        <th>Date de soumission</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingConventions as $conv)
                        <tr>
                            <td>{{ $conv->student->user->name ?? '-' }}</td>
                            <td>{{ $conv->company->name ?? '-' }}</td>
                            <td>{{ $conv->created_at->format('d/m/Y') }}</td>
                            <td><span class="badge badge-warning">En attente</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-success mr-1">Valider</a>
                                <a href="#" class="btn btn-sm btn-danger">Rejeter</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucune convention à valider.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Étudiants encadrés</h2>
        </div>
        <div class="students-list d-flex gap-3">
            @forelse($studentsSupervised as $student)
                <div class="student-card">
                    <h3>{{ $student->user->name ?? '-' }}</h3>
                    <p>{{ $student->offers->last()->title ?? '-' }} - {{ $student->offers->last()->company->name ?? '-' }}</p>
                    <span class="badge badge-success">Stage en cours</span>
                </div>
            @empty
                <div class="text-muted">Aucun étudiant encadré actuellement.</div>
            @endforelse
        </div>
    </div>
    @include('components.footer')
</div>
@endsection

