<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    /**
     * Afficher la liste des rapports.
     */
    public function index()
    {
        $rapports = Rapport::with('administrateur')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('rapports.index', compact('rapports'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('rapports.create');
    }

    /**
     * Enregistrer un nouveau rapport.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        Rapport::create([
            'date_generation' => now(),
            'type' => $request->type,
            'administrateur_id' => request()->user()->id,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()
            ->route('rapports.index')
            ->with('success', 'Rapport enregistré avec succès.');
    }

    /**
     * Afficher un rapport.
     */
    public function show(Rapport $rapport)
    {
        $rapport->load('administrateur');

        return view('rapports.show', compact('rapport'));
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Rapport $rapport)
    {
        return view('rapports.edit', compact('rapport'));
    }

    /**
     * Modifier un rapport.
     */
    public function update(Request $request, Rapport $rapport)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $rapport->update([
            'date_generation' => now(),
            'type' => $request->type,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()
            ->route('rapports.index')
            ->with('success', 'Rapport modifié avec succès.');
    }

    /**
     * Supprimer un rapport.
     */
    public function destroy(Rapport $rapport)
    {
        $rapport->delete();

        return redirect()
            ->route('rapports.index')
            ->with('success', 'Rapport supprimé avec succès.');
    }
}