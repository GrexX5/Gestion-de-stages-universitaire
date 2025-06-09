@extends('layouts.app')
@section('title', 'Déposer une candidature')
@section('content')
<div class="dashboard-container">
    <h1>Déposer une candidature</h1>
    <form method="POST" action="#" class="card" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="offer">Offre de stage</label>
            <select class="form-control" id="offer" name="offer_id" required>
                <option value="">Sélectionner une offre</option>
                <option value="1">Développeur Web - TechCorp</option>
                <option value="2">Data Analyst - DataCorp</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cv">CV (PDF)</label>
            <input type="file" class="form-control" id="cv" name="cv" accept="application/pdf" required>
        </div>
        <div class="form-group">
            <label for="cover_letter">Lettre de motivation</label>
            <textarea class="form-control" id="cover_letter" name="cover_letter" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Soumettre la candidature</button>
    </form>
    @include('components.footer')
</div>
@endsection
