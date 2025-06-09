<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Convention;
use App\Models\Student;

class TeacherDashboardController extends Controller
{
    public function dashboard()
    {
        $teacherId = Auth::id();
        // Conventions à valider (statut 'pending' et assignées à ce prof)
        $pendingConventions = Convention::where('teacher_id', $teacherId)->where('status', 'pending')->with('student', 'company')->latest()->take(5)->get();
        $pendingCount = $pendingConventions->count();
        $validatedCount = Convention::where('teacher_id', $teacherId)->where('status', 'validated')->count();
        $studentsSupervised = Student::where('teacher_id', $teacherId)->with('offers')->get();
        $studentsCount = $studentsSupervised->count();
        return view('teacher.dashboard', compact('pendingConventions', 'pendingCount', 'validatedCount', 'studentsSupervised', 'studentsCount'));
    }
}
