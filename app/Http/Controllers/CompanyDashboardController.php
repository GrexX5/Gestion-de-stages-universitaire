<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    public function dashboard()
    {
        $companyId = Auth::id();
        $offers = Offer::where('company_id', $companyId)->latest()->take(5)->get();
        $offersCount = Offer::where('company_id', $companyId)->count();
        // Récupérer les 5 dernières candidatures reçues pour les offres de l'entreprise
        $recentApplications = \App\Models\Application::whereHas('offer', function($q) use ($companyId) {
            $q->where('company_id', $companyId);
        })->with(['student.user', 'offer'])->latest()->take(5)->get();
        $applicationsCount = 0;
        $positionsFilled = 0;
        return view('company.dashboard', compact('offers', 'offersCount', 'applicationsCount', 'positionsFilled', 'recentApplications'));
    }
}
