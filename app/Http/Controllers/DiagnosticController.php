<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\Parcelle;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'maladie_detectee' => 'required|boolean',
            'nom_maladie' => 'nullable|string',
            'date_analyse' => 'required|date',
            'niveau_confiance' => 'required|numeric',
            'parcelles' => 'required|array',
            'parcelles.*' => 'exists:parcelles,id',
        ]);

        $diagnostic = Diagnostic::create($validated);
        $diagnostic->parcelles()->sync($validated['parcelles']);

        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic enregistré avec succès');
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

        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic mis à jour');
    }

    public function destroy(Diagnostic $diagnostic)
    {
        $diagnostic->delete();
        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic supprimé');
    }
}
