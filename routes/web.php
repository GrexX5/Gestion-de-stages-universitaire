<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('home');
})->name('home');

// Tableau de bord par défaut (redirigé si l'utilisateur n'a pas de rôle spécifique)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Tableau de bord étudiant
Route::prefix('student')->name('student.')->middleware(['auth', 'verified', 'role:student'])->group(function () {
    // Mes candidatures (dashboard étudiant et page dédiée)
    Route::get('/applications', [App\Http\Controllers\ApplicationController::class, 'indexEtudiant'])->name('applications.index');
    // Soumettre une candidature à une offre
    Route::post('/offers/{offer}/apply', [App\Http\Controllers\ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/dashboard', [App\Http\Controllers\StudentDashboardController::class, 'dashboard'])->name('dashboard');

    // Mes candidatures
    Route::get('/applications', [App\Http\Controllers\ApplicationController::class, 'indexEtudiant'])->name('applications.index');

    // Rechercher des offres
    Route::get('/offers', function () {
        return view('student.offers');
    })->name('offers.index');
});

// Tableau de bord enseignant
Route::prefix('teacher')->name('teacher.')->middleware(['auth', 'verified', 'role:teacher'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\TeacherDashboardController::class, 'dashboard'])->name('dashboard');

    // Conventions à valider
    Route::get('/conventions', [App\Http\Controllers\TeacherConventionsController::class, 'index'])->name('conventions.index');

    // Étudiants encadrés
    Route::get('/students', [App\Http\Controllers\TeacherStudentsController::class, 'index'])->name('students.index');
});

// Tableau de bord entreprise
Route::prefix('company')->name('company.')->middleware(['auth', 'verified', 'role:company'])->group(function () {
    // Candidatures reçues (dashboard entreprise et page dédiée)
    Route::get('/applications', [App\Http\Controllers\ApplicationController::class, 'indexEntreprise'])->name('applications.index');
    Route::patch('/applications/{id}/status', [App\Http\Controllers\ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
    Route::get('/dashboard', [App\Http\Controllers\CompanyDashboardController::class, 'dashboard'])->name('dashboard');

    // CRUD complet des offres de stage (resource)
    Route::resource('offers', App\Http\Controllers\OfferController::class);

    // Candidatures reçues
    Route::get('/applications', [App\Http\Controllers\ApplicationController::class, 'indexEntreprise'])->name('applications.index');
});

// Tableau de bord enseignant
Route::prefix('teacher')->name('teacher.')->middleware(['auth', 'verified', 'role:teacher'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\TeacherDashboardController::class, 'dashboard'])->name('dashboard');
});



// Tableau de bord entreprise


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Voir le détail d'une candidature (commun)
Route::get('/applications/{id}', [App\Http\Controllers\ApplicationController::class, 'show'])->name('applications.show');

require __DIR__.'/auth.php';
