<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Company;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load(['student', 'teacher', 'company']);
        $profile = null;
        
        // Récupérer le profil spécifique en fonction du rôle
        if ($user->isStudent()) {
            $profile = $user->student ?? new Student(['user_id' => $user->id]);
        } elseif ($user->isTeacher()) {
            $profile = $user->teacher ?? new Teacher(['user_id' => $user->id]);
        } elseif ($user->isCompany()) {
            $profile = $user->company ?? new Company(['user_id' => $user->id]);
        }

        return view('profile.edit', [
            'user' => $user,
            'profile' => $profile,
            'role' => $user->role,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Démarrer une transaction pour assurer l'intégrité des données
        DB::beginTransaction();
        
        try {
            // Mettre à jour les informations de base de l'utilisateur
            $user->fill($request->validated());

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            // Mettre à jour le profil spécifique
            $this->updateUserProfile($user, $request->all());
            
            DB::commit();
            
            return $this->redirectToDashboard($user, 'profile-updated')
                ->with('status', 'Profil mis à jour avec succès !');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la mise à jour du profil: ' . $e->getMessage());
            
            return back()->withErrors([
                'error' => 'Une erreur est survenue lors de la mise à jour de votre profil.'
            ])->withInput();
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        
        // Démarrer une transaction pour assurer l'intégrité des données
        DB::beginTransaction();
        
        try {
            // Supprimer le profil spécifique si nécessaire
            if ($user->student) {
                $user->student->delete();
            } elseif ($user->teacher) {
                $user->teacher->delete();
            } elseif ($user->company) {
                $user->company->delete();
            }
            
            // Déconnecter l'utilisateur
            Auth::logout();
            
            // Supprimer l'utilisateur
            $user->delete();
            
            DB::commit();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return Redirect::to('/')->with('status', 'Votre compte a été supprimé avec succès.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la suppression du compte: ' . $e->getMessage());
            
            return back()->withErrors([
                'error' => 'Une erreur est survenue lors de la suppression de votre compte.'
            ]);
        }
    }

    /**
     * Met à jour le profil spécifique de l'utilisateur en fonction de son rôle.
     *
     * @param  \App\Models\User  $user
     * @param  array  $data
     * @return void
     */
    protected function updateUserProfile($user, $data)
    {
        if ($user->isStudent()) {
            $this->updateStudentProfile($user, $data);
        } elseif ($user->isTeacher()) {
            $this->updateTeacherProfile($user, $data);
        } elseif ($user->isCompany()) {
            $this->updateCompanyProfile($user, $data);
        }
    }

    /**
     * Met à jour le profil étudiant.
     *
     * @param  \App\Models\Student  $student
     * @param  array  $data
     * @return void
     */
    protected function updateStudentProfile($user, array $data)
    {
        $studentData = [
            'user_id' => $user->id,
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'birth_date' => $data['birth_date'] ?? null,
            'program' => $data['program'] ?? null,
            'year_of_study' => isset($data['year_of_study']) ? (int)$data['year_of_study'] : null,
        ];
        
        if ($user->student) {
            $user->student->update($studentData);
        } else {
            $user->student()->create($studentData);
        }
    }

    /**
     * Met à jour le profil enseignant.
     *
     * @param  \App\Models\User  $user
     * @param  array  $data
     * @return void
     */
    protected function updateTeacherProfile($user, array $data)
    {
        $teacherData = [
            'user_id' => $user->id,
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'department' => $data['department'] ?? null,
            'specialization' => $data['specialization'] ?? null,
        ];
        
        if ($user->teacher) {
            $user->teacher->update($teacherData);
        } else {
            $user->teacher()->create($teacherData);
        }
    }

    /**
     * Met à jour le profil entreprise.
     *
     * @param  \App\Models\User  $user
     * @param  array  $data
     * @return void
     */
    protected function updateCompanyProfile($user, array $data)
    {
        $companyData = [
            'user_id' => $user->id,
            'siret' => $data['siret'] ?? null,
            'naf_code' => $data['naf_code'] ?? null,
            'legal_status' => $data['legal_status'] ?? null,
            'description' => $data['description'] ?? null,
            'website' => $data['website'] ?? null,
            'address' => $data['address'] ?? null,
            'postal_code' => $data['postal_code'] ?? null,
            'city' => $data['city'] ?? null,
            'country' => $data['country'] ?? 'France',
        ];
        
        // Nettoyer les données pour enlever les valeurs null
        $companyData = array_filter($companyData, function($value) {
            return $value !== null;
        });
        
        if ($user->company) {
            $user->company->update($companyData);
        } else {
            $user->company()->create($companyData);
        }
    }

    /**
     * Redirige vers le tableau de bord approprié en fonction du rôle de l'utilisateur.
     *
     * @param  \App\Models\User  $user
     * @param  string  $status
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToDashboard($user, $status = null)
    {
        $route = match($user->role) {
            'student' => 'student.dashboard',
            'teacher' => 'teacher.dashboard',
            'company' => 'company.dashboard',
            default => 'dashboard',
        };

        return Redirect::route($route)->with('status', $status);
    }
}
