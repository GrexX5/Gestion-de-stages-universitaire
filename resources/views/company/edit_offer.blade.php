@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Modifier une offre</h1>
    <form method="POST" action="{{ route('company.offers.update', $offer->id) }}">
        @csrf
        @method('PUT')
        @include('company.partials.offer_form', ['offer' => $offer])
        <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>
        <a href="{{ route('company.offers.index') }}" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>
@endsection
