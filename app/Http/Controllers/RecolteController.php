<?php

namespace App\Http\Controllers;

use App\Models\Recolte;
use App\Models\Contremaitre;
use Illuminate\Http\Request;

class RecolteController extends Controller
{
    public function index()
    {
        $recoltes = Recolte::with('contremaitre')->get();
        return view('recoltes.index', compact('recoltes'));
    }

    public function create()
    {
        $contremaitres = Contremaitre::all();
        return view('recoltes.create', compact('contremaitres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'date_recolte' => 'required|date',
            'quantite' => 'required|numeric',
            'unite' => 'required|string',
            'contremaitre_id' => 'required|exists:contremaitres,id',
        ]);

        Recolte::create($validated);
        return redirect()->route('recoltes.index')->with('success', 'Récolte enregistrée avec succès');
    }

    public function show(Recolte $recolte)
    {
        $recolte->load('contremaitre');
        return view('recoltes.show', compact('recolte'));
    }

    public function edit(Recolte $recolte)
    {
        $contremaitres = Contremaitre::all();
        return view('recoltes.edit', compact('recolte', 'contremaitres'));
    }

    public function update(Request $request, Recolte $recolte)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'date_recolte' => 'required|date',
            'quantite' => 'required|numeric',
            'unite' => 'required|string',
            'contremaitre_id' => 'required|exists:contremaitres,id',
        ]);

        $recolte->update($validated);
        return redirect()->route('recoltes.index')->with('success', 'Récolte mise à jour');
    }

    public function destroy(Recolte $recolte)
    {
        $user = request()->user();

        // L'administrateur peut supprimer n'importe quelle récolte
        if ($user->administrateur) {
            $recolte->delete();

            return redirect()
                ->route('recoltes.index')
                ->with('success', 'Récolte supprimée avec succès.');
        }

        // Récupérer le contremaître connecté
        $contremaitre = $user->contremaitre;

        if (!$contremaitre) {
            abort(403, 'Accès non autorisé.');
        }

        // Le contremaître ne peut supprimer que ses propres récoltes
        if ($recolte->contremaitre_id !== $contremaitre->id) {
            abort(403, 'Vous ne pouvez pas supprimer cette récolte.');
        }

        $recolte->delete();

        return redirect()
            ->route('recoltes.index')
            ->with('success', 'Récolte supprimée avec succès.');
    }
}