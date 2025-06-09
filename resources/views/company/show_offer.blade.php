@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Détail de l'offre</h1>
    <div class="card">
        <div class="card-body">
            <h3>{{ $offer->title }}</h3>
            <p><strong>Lieu :</strong> {{ $offer->location }}</p>
            <p><strong>Durée :</strong> {{ $offer->duration }}</p>
            <p><strong>Date début :</strong> {{ $offer->start_date ? $offer->start_date->format('d/m/Y') : '-' }}</p>
            <p><strong>Date fin :</strong> {{ $offer->end_date ? $offer->end_date->format('d/m/Y') : '-' }}</p>
            <p><strong>Description :</strong><br>{{ $offer->description }}</p>
            <p><strong>Statut :</strong> <span class="badge badge-{{ $offer->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($offer->status) }}</span></p>
            <a href="{{ route('company.offers.edit', $offer->id) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('company.offers.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
