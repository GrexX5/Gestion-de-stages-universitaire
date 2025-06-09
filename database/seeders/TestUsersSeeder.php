<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'un étudiant
        User::create([
            'name' => 'Étudiant Test',
            'email' => 'etudiant@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);

        // Création d'un enseignant
        User::create([
            'name' => 'Enseignant Test',
            'email' => 'enseignant@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'is_active' => true,
        ]);

        // Création d'une entreprise
        User::create([
            'name' => 'Entreprise Test',
            'email' => 'entreprise@example.com',
            'password' => Hash::make('password'),
            'role' => 'company',
            'is_active' => true,
        ]);

        $this->command->info('3 utilisateurs de test créés avec succès !');
    }
}
