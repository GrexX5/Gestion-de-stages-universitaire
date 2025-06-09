<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        $user = Auth::user();
        
        // Vérifier si le compte est actif
        if (isset($user->is_active) && !$user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')
                ->with('error', 'Votre compte a été désactivé. Veuillez contacter l\'administrateur.');
        }
        
        // Vérifier si l'utilisateur a l'un des rôles requis
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }
        }

        // Journaliser la tentative d'accès non autorisée
        Log::warning('Tentative d\'accès non autorisée', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $user->role,
            'required_roles' => $roles,
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
        ]);

        // Rediriger vers le tableau de bord approprié avec un message d'erreur
        $redirectRoute = match($user->role) {
            'student' => 'student.dashboard',
            'teacher' => 'teacher.dashboard',
            'company' => 'company.dashboard',
            default => 'dashboard',
        };

        return redirect()->route($redirectRoute)
            ->with('error', 'Accès refusé : vous n\'avez pas les autorisations nécessaires pour accéder à cette page.');
    }
}
