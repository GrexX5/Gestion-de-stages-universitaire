<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', [
            'roles' => [
                'student' => 'Étudiant',
                'teacher' => 'Enseignant',
                'company' => 'Entreprise'
            ]
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Règles de validation de base
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:student,teacher,company',
            'password' => 'required|string|min:6|confirmed', // min 6 pour être plus souple
            'password_confirmation' => 'required|string|same:password',
        ];

        // Validation initiale des champs communs
        $validated = $request->validate($rules);
        dd($validated);

        // Validation des champs spécifiques au rôle
        $roleSpecificRules = [];
        
        if ($validated['role'] === 'student') {
            $roleSpecificRules = [
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'birth_date' => 'nullable|date',
                'program' => 'nullable|string|max:255',
                'year_of_study' => 'nullable|integer|min:1|max:10',
            ];
        } elseif ($validated['role'] === 'teacher') {
            $roleSpecificRules = [
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'department' => 'nullable|string|max:255',
                'specialization' => 'nullable|string|max:255',
            ];
        } elseif ($validated['role'] === 'company') {
            $roleSpecificRules = [
                'siret' => 'nullable|string|size:14',
                'description' => 'nullable|string|max:1000',
                'address' => 'nullable|string|max:255',
                'postal_code' => 'nullable|string|max:10',
                'city' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
            ];
        }

        // Validation des champs spécifiques au rôle (souple)
        if (!empty($roleSpecificRules)) {
            $roleValidated = $request->validate($roleSpecificRules);
            $validated = array_merge($validated, $roleValidated);
        }

        DB::beginTransaction();

        try {
            // Création de l'utilisateur
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'password' => Hash::make($validated['password']),
            ]);

            // Création du profil spécifique selon le rôle
            if ($user->role === 'student') {
                $studentData = array_filter([
                    'student_number' => $validated['student_number'] ?? null,
                    'first_name' => $validated['first_name'] ?? null,
                    'last_name' => $validated['last_name'] ?? null,
                    'birth_date' => $validated['birth_date'] ?? null,
                    'program' => $validated['program'] ?? null,
                    'year_of_study' => $validated['year_of_study'] ?? null,
                ], function ($v) { return !is_null($v) && $v !== ''; });
                $user->student()->create($studentData);
            } elseif ($user->role === 'teacher') {
                $teacherData = array_filter([
                    'first_name' => $validated['first_name'] ?? null,
                    'last_name' => $validated['last_name'] ?? null,
                    'department' => $validated['department'] ?? null,
                    'specialization' => $validated['specialization'] ?? null,
                ], function ($v) { return !is_null($v) && $v !== ''; });
                $user->teacher()->create($teacherData);
            } elseif ($user->role === 'company') {
                $companyData = array_filter([
                    'siret' => $validated['siret'] ?? null,
                    'description' => $validated['description'] ?? null,
                    'address' => $validated['address'] ?? null,
                    'postal_code' => $validated['postal_code'] ?? null,
                    'city' => $validated['city'] ?? null,
                    'country' => $validated['country'] ?? null,
                ], function ($v) { return !is_null($v) && $v !== ''; });
                $user->company()->create($companyData);
            }

            event(new Registered($user));
            Auth::login($user);

            DB::commit();

            // Redirection en fonction du rôle
            return match($user->role) {
                'student' => redirect(route('student.dashboard'))
                    ->with('status', 'Inscription réussie ! Bienvenue sur votre espace étudiant.'),
                'teacher' => redirect(route('teacher.dashboard'))
                    ->with('status', 'Inscription réussie ! Bienvenue sur votre espace enseignant.'),
                'company' => redirect(route('company.dashboard'))
                    ->with('status', 'Inscription réussie ! Bienvenue sur votre espace entreprise.'),
                default => redirect(route('dashboard')),
            };

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            $message = $e->getMessage();
            if (str_contains($message, 'unique')) {
                $msg = 'Un champ unique est déjà utilisé (email ou SIRET). Veuillez en choisir un autre.';
            } else {
                $msg = $message;
            }
            Log::error('Erreur validation inscription : ' . $message);
            return back()->withErrors(['error' => $msg]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'inscription : ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return back()->withErrors(['error' => 'Erreur technique : ' . $e->getMessage()]);
        }
    }
}
