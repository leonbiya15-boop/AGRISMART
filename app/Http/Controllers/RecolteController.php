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
        $recolte->delete();
        return redirect()->route('recoltes.index')->with('success', 'Récolte supprimée');
    }
}
