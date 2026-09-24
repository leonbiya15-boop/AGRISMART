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
        $this->authorize('create', Recolte::class);

        $contremaitres = Contremaitre::all();
        return view('recoltes.create', compact('contremaitres'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Recolte::class);

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
        $this->authorize('update', $recolte);

        $contremaitres = Contremaitre::all();
        return view('recoltes.edit', compact('recolte', 'contremaitres'));
    }

    public function update(Request $request, Recolte $recolte)
    {
        $this->authorize('update', $recolte);

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
        $this->authorize('delete', $recolte);

        $recolte->delete();

        return redirect()
            ->route('recoltes.index')
            ->with('success', 'Récolte supprimée avec succès.');
    }
}