<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Offer;

class StudentDashboardController extends Controller
{
    public function dashboard()
    {
        $studentId = Auth::id();
        $applications = Application::where('student_id', $studentId)->with('offer')->latest()->take(5)->get();
        $applicationsCount = Application::where('student_id', $studentId)->count();
        $acceptedCount = Application::where('student_id', $studentId)->where('status', 'accepted')->count();
        $pendingCount = Application::where('student_id', $studentId)->where('status', 'submitted')->count();
        $savedOffersCount = 0; // À implémenter si tu veux la fonctionnalité "offres sauvegardées"
        $recommendedOffers = Offer::latest()->take(2)->get();
        return view('student.dashboard', compact('applications', 'applicationsCount', 'acceptedCount', 'pendingCount', 'savedOffersCount', 'recommendedOffers'));
    }
}
