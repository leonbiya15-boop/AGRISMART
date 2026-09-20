<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\Models\Parcelle;
use Illuminate\Http\Request;

class CultureController extends Controller
{
    public function index()
    {
        $cultures = Culture::with('parcelle')->get();
        return view('cultures.index', compact('cultures'));
    }

    public function create()
    {
        $parcelles = Parcelle::all();
        return view('cultures.create', compact('parcelles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'famille' => 'required|string',
            'parcelle_id' => 'required|exists:parcelles,id',
        ]);

        Culture::create($validated);
        return redirect()->route('cultures.index')->with('success', 'Culture créée avec succès');
    }

    public function show(Culture $culture)
    {
        $culture->load('parcelle');
        return view('cultures.show', compact('culture'));
    }

    public function edit(Culture $culture)
    {
        $parcelles = Parcelle::all();
        return view('cultures.edit', compact('culture', 'parcelles'));
    }

    public function update(Request $request, Culture $culture)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'famille' => 'required|string',
            'parcelle_id' => 'required|exists:parcelles,id',
        ]);

        $culture->update($validated);
        return redirect()->route('cultures.index')->with('success', 'Culture mise à jour');
    }

   public function destroy(Culture $culture)
{
    $user = request()->user();

    // L'administrateur peut supprimer n'importe quelle culture
    if ($user->administrateur) {
        $culture->delete();

        return redirect()
            ->route('cultures.index')
            ->with('success', 'Culture supprimée avec succès.');
    }

    // Récupérer le contremaître connecté
    $contremaitre = $user->contremaitre;

    if (!$contremaitre) {
        abort(403, 'Accès non autorisé.');
    }

    // Vérifier que la culture appartient à une parcelle
    // appartenant au contremaître connecté
    if (!$culture->parcelle || $culture->parcelle->contremaitre_id !== $contremaitre->id) {
        abort(403, 'Vous ne pouvez pas supprimer cette culture.');
    }

    $culture->delete();

    return redirect()
        ->route('cultures.index')
        ->with('success', 'Culture supprimée avec succès.');
}
}
