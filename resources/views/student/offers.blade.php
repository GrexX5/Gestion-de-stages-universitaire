@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Offres de stage disponibles</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Entreprise</th>
                    <th>Lieu</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($offers as $offer)
                    <tr>
                        <td>{{ $offer->title }}</td>
                        <td>{{ $offer->company->name ?? '-' }}</td>
                        <td>{{ $offer->location }}</td>
                        <td>{{ $offer->start_date ? $offer->start_date->format('d/m/Y') : '-' }}</td>
                        <td>{{ $offer->end_date ? $offer->end_date->format('d/m/Y') : '-' }}</td>
                        <td>
                            <form action="{{ route('student.applications.store', $offer) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Postuler</button>
                            </form>
                            <button class="btn btn-sm btn-outline-secondary">Sauvegarder</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Aucune offre disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $offers->links() }}
        </div>
    </div>
@endsection
