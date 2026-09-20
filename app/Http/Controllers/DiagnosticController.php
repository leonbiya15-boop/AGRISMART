<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\Parcelle;
use App\Services\IAService;
use Illuminate\Http\Request;
use App\Models\Alerte;

class DiagnosticController extends Controller
{
    public function index()
    {
        $diagnostics = Diagnostic::with('parcelles')->get();
        return view('diagnostics.index', compact('diagnostics'));
    }

    public function create()
    {
        $parcelles = Parcelle::all();
        return view('diagnostics.create', compact('parcelles'));
    }

    public function store(Request $request, IAService $ia)
    {
        $validated = $request->validate([
            'photo' => 'required|image|max:5120',
            'parcelles' => 'required|array',
            'parcelles.*' => 'exists:parcelles,id',
        ]);

        $cheminPhoto = $request->file('photo')->store('diagnostics', 'public');

        $resultat = $ia->analyserPhotoMaladie($cheminPhoto);

        $diagnostic = Diagnostic::create([
            'maladie_detectee' => $resultat['maladie_detectee'],
            'nom_maladie' => $resultat['nom_maladie'],
            'niveau_confiance' => $resultat['niveau_confiance'],
            'date_analyse' => now(),
            'photo' => $cheminPhoto,
        ]);

        $diagnostic->parcelles()->sync($validated['parcelles']);

        if ($diagnostic->maladie_detectee) {
            foreach ($diagnostic->parcelles as $parcelle) {
                Alerte::create([
                    'diagnostic_id' => $diagnostic->id,
                    'parcelle_id' => $parcelle->id,
                    'message' => 'Maladie détectée : '.$diagnostic->nom_maladie.' sur la parcelle '.$parcelle->nom,
                    'statut' => 'nouvelle',
                ]);
            }
        }

        return redirect()->route('diagnostics.index')->with('success', 'Photo analysée par l\'IA avec succès');
    }

    public function show(Diagnostic $diagnostic)
    {
        $diagnostic->load('parcelles');
        return view('diagnostics.show', compact('diagnostic'));
    }

    public function edit(Diagnostic $diagnostic)
    {
        $parcelles = Parcelle::all();
        $diagnostic->load('parcelles');
        return view('diagnostics.edit', compact('diagnostic', 'parcelles'));
    }

    public function update(Request $request, Diagnostic $diagnostic)
    {
        $validated = $request->validate([
            'maladie_detectee' => 'required|boolean',
            'nom_maladie' => 'nullable|string',
            'date_analyse' => 'required|date',
            'niveau_confiance' => 'required|numeric',
            'parcelles' => 'required|array',
            'parcelles.*' => 'exists:parcelles,id',
        ]);

        $diagnostic->update($validated);
        $diagnostic->parcelles()->sync($validated['parcelles']);

        if ($diagnostic->maladie_detectee) {
            foreach ($diagnostic->parcelles as $parcelle) {
                Alerte::firstOrCreate([
                    'diagnostic_id' => $diagnostic->id,
                    'parcelle_id' => $parcelle->id,
                ], [
                    'message' => 'Maladie détectée : '.$diagnostic->nom_maladie.' sur la parcelle '.$parcelle->nom,
                    'statut' => 'nouvelle',
                ]);
            }
        }

        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic mis à jour');
    }

    public function destroy(Diagnostic $diagnostic)
    {
        $diagnostic->delete();
        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic supprimé');
    }
}