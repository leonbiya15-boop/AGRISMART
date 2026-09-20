<?php

namespace App\Http\Controllers;

use App\Models\Parcelle;
use App\Models\Contremaitre;
use Illuminate\Http\Request;

class ParcelleController extends Controller
{
    public function index()
    {
        $parcelles = Parcelle::with(['cultures', 'contremaitre.utilisateur'])->latest()->get();
        return view('parcelles.index', compact('parcelles'));
    }

    public function create()
{
    $contremaitres = Contremaitre::all();
    return view('parcelles.create', compact('contremaitres'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'superficie' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contremaitre_id' => 'required|exists:contremaitres,id',
        ]);

        Parcelle::create($validated);
        return redirect()->route('parcelles.index')->with('success', 'Parcelle créée avec succès');
    }

    public function show(Parcelle $parcelle)
    {
        $parcelle->load('cultures', 'diagnostics', 'rotations');
        return view('parcelles.show', compact('parcelle'));
    }

    public function edit(Parcelle $parcelle)
    {
        $contremaitres = Contremaitre::with('utilisateur')->get();
        return view('parcelles.edit', compact('parcelle', 'contremaitres'));
    }

    public function update(Request $request, Parcelle $parcelle)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'superficie' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contremaitre_id' => 'required|exists:contremaitres,id',
        ]);

        $parcelle->update($validated);
        return redirect()->route('parcelles.index')->with('success', 'Parcelle mise à jour');
    }

   public function destroy(Parcelle $parcelle)
{
    $user = request()->user();

    // L'administrateur peut supprimer n'importe quelle parcelle
    if ($user->administrateur) {
        $parcelle->delete();

        return redirect()
            ->route('parcelles.index')
            ->with('success', 'Parcelle supprimée avec succès.');
    }

    // Récupérer le contremaître connecté
    $contremaitre = $user->contremaitre;

    if (!$contremaitre) {
        abort(403, 'Accès non autorisé.');
    }

    // Le contremaître ne peut supprimer que ses propres parcelles
    if ($parcelle->contremaitre_id !== $contremaitre->id) {
        abort(403, 'Vous ne pouvez pas supprimer cette parcelle.');
    }

    $parcelle->delete();

    return redirect()
        ->route('parcelles.index')
        ->with('success', 'Parcelle supprimée avec succès.');
}
}
