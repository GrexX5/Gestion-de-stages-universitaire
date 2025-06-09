<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    // Afficher la liste des offres de l'entreprise connectée
    public function index()
    {
        $offers = \App\Models\Offer::where('company_id', auth()->id())->latest()->paginate(10);
        return view('company.offers', compact('offers'));
    }

    // Afficher le formulaire de création d'offre
    public function create()
    {
        return view('company.create_offer');
    }

    // Enregistrer une nouvelle offre
    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        $data['company_id'] = auth()->id();
        $data['status'] = 'active';
        $offer = \App\Models\Offer::create($data);
        return redirect()->route('company.offers.index')->with('status', 'Offre créée avec succès.');
    }

    // Afficher le détail d'une offre
    public function show($id)
    {
        $offer = \App\Models\Offer::where('company_id', auth()->id())->findOrFail($id);
        return view('company.show_offer', compact('offer'));
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $offer = \App\Models\Offer::where('company_id', auth()->id())->findOrFail($id);
        return view('company.edit_offer', compact('offer'));
    }

    // Mettre à jour une offre
    public function update(\Illuminate\Http\Request $request, $id)
    {
        $offer = \App\Models\Offer::where('company_id', auth()->id())->findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);
        $offer->update($data);
        return redirect()->route('company.offers.index')->with('status', 'Offre modifiée avec succès.');
    }

    // Supprimer une offre
    public function destroy($id)
    {
        $offer = \App\Models\Offer::where('company_id', auth()->id())->findOrFail($id);
        $offer->delete();
        return redirect()->route('company.offers.index')->with('status', 'Offre supprimée.');
    }


}
