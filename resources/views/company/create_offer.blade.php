@extends('layouts.app')
@section('title', 'Publier une offre de stage')
@section('content')
<div class="dashboard-container">
    <h1>Publier une nouvelle offre de stage</h1>
    <form method="POST" action="{{ route('company.offers.store') }}">
        @csrf
        @include('company.partials.offer_form')
        <button type="submit" class="btn btn-primary mt-2">Publier l'offre</button>
    </form>
    @include('components.footer')
</div>
@endsection
