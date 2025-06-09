@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Étudiants encadrés</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Dernier stage</th>
                    <th>Entreprise</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->user->name ?? '-' }}</td>
                        <td>{{ $student->offers->last()->title ?? '-' }}</td>
                        <td>{{ $student->offers->last()->company->name ?? '-' }}</td>
                        <td><a href="#" class="btn btn-sm btn-primary">Voir</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Aucun étudiant encadré.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $students->links() }}
        </div>
    </div>
@endsection
