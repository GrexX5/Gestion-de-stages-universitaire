<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // Authentification sans validation stricte
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();

                /** @var \App\Models\User $user */
                $user = Auth::user();
                
                // Vérifier si l'utilisateur est actif
                if (!$user->is_active) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return back()->withErrors([
                        'email' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur.',
                    ]);
                }
                
                // Redirection en fonction du rôle avec message de bienvenue
                $redirectTo = match($user->role) {
                    'student' => [
                        'url' => route('student.dashboard'),
                        'message' => 'Connexion réussie ! Bienvenue sur votre espace étudiant.'
                    ],
                    'teacher' => [
                        'url' => route('teacher.dashboard'),
                        'message' => 'Connexion réussie ! Bienvenue sur votre espace enseignant.'
                    ],
                    'company' => [
                        'url' => route('company.dashboard'),
                        'message' => 'Connexion réussie ! Bienvenue sur votre espace entreprise.'
                    ],
                    default => [
                        'url' => route('dashboard'),
                        'message' => 'Connexion réussie !'
                    ],
                };

                return redirect()->intended($redirectTo['url'])
                    ->with('status', $redirectTo['message']);
            }
            return back()->withErrors(['email' => 'Identifiants invalides ou manquants.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Erreur lors de la connexion : ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Une erreur est survenue lors de la connexion. Veuillez réessayer.',
            ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
