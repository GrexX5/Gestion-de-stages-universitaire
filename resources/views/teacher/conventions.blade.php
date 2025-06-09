@extends('layouts.app')
@section('title', 'Conventions à valider')
@section('content')
<div class="dashboard-container">
    <h1>Conventions à valider</h1>
    <div class="card">
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
                @forelse($conventions as $conv)
                <tr>
                    <td>{{ $conv->student->user->name ?? '-' }}</td>
                    <td>{{ $conv->company->name ?? '-' }}</td>
                    <td>{{ $conv->created_at->format('d/m/Y') }}</td>
                    <td><span class="badge badge-{{ $conv->status === 'pending' ? 'warning' : ($conv->status === 'validated' ? 'success' : 'secondary') }}">{{ ucfirst($conv->status) }}</span></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-success mr-1">Valider</a>
                        <a href="#" class="btn btn-sm btn-danger">Rejeter</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune convention trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @include('components.footer')
    <div class="mt-3">
        {{ $conventions->links() }}
    </div>
</div>
@endsection
