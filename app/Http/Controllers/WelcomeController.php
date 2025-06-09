<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Si l'utilisateur est déjà connecté, on le redirige vers le tableau de bord approprié
        if (Auth::check()) {
            $user = Auth::user();
            
            // Redirection en fonction du rôle
            return match($user->role) {
                'student' => redirect()->route('student.dashboard'),
                'teacher' => redirect()->route('teacher.dashboard'),
                'company' => redirect()->route('company.dashboard'),
                default => redirect()->route('dashboard'),
            };
        }

        return view('welcome');
    }
}
