<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Afficher les candidatures reçues pour une entreprise
    public function indexEntreprise()
    {
        $companyId = Auth::id();
        $applications = Application::whereHas('offer', function($q) use ($companyId) {
            $q->where('company_id', $companyId);
        })->with(['offer', 'student'])->latest()->paginate(10);
        return view('company.applications', compact('applications'));
    }

    // Afficher les candidatures de l'étudiant connecté
    public function indexEtudiant()
    {
        $studentId = Auth::id();
        $applications = Application::where('student_id', $studentId)->with('offer')->latest()->paginate(10);
        return view('student.applications', compact('applications'));
    }

    // Soumettre une candidature à une offre
    public function store(Request $request, $offerId)
    {
        $request->validate([
            'motivation_letter' => 'nullable|string',
            'cv_path' => 'required|string', // Pour l'exemple, à remplacer par upload réel
            'transcript_path' => 'nullable|string',
            'other_documents' => 'nullable|string',
        ]);
        $application = Application::create([
            'offer_id' => $offerId,
            'student_id' => Auth::id(),
            'motivation_letter' => $request->motivation_letter,
            'cv_path' => $request->cv_path,
            'transcript_path' => $request->transcript_path,
            'other_documents' => $request->other_documents,
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);
        return redirect()->route('student.applications.index')->with('success', 'Candidature soumise avec succès !');
    }

    // Voir le détail d'une candidature (côté entreprise ou étudiant)
    public function show($id)
    {
        $application = Application::with(['offer', 'student'])->findOrFail($id);
        return view('applications.show', compact('application'));
    }

    // Accepter/refuser une candidature (côté entreprise)
    public function updateStatus(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $request->validate([
            'status' => 'required|in:accepted,rejected',
            'feedback' => 'nullable|string',
        ]);
        if ($request->status === 'accepted') {
            $application->markAsAccepted(Auth::user(), $request->feedback);
        } else {
            $application->markAsRejected(Auth::user(), $request->feedback);
        }
        return redirect()->back()->with('success', 'Statut de la candidature mis à jour.');
    }
}
