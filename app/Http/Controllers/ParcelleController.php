<?php

namespace App\Http\Controllers;

use App\Models\Parcelle;
use App\Models\Contremaitre;
use Illuminate\Http\Request;

class ParcelleController extends Controller
{
    public function index()
    {
        $parcelles = Parcelle::with('cultures')->get();
        return view('parcelles.index', compact('parcelles'));
    }

    public function create()
{
    $contremaitres = \App\Models\Contremaitre::all();
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
        return view('parcelles.edit', compact('parcelle'));
    }

    public function update(Request $request, Parcelle $parcelle)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'superficie' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $parcelle->update($validated);
        return redirect()->route('parcelles.index')->with('success', 'Parcelle mise à jour');
    }

    public function destroy(Parcelle $parcelle)
    {
        $parcelle->delete();
        return redirect()->route('parcelles.index')->with('success', 'Parcelle supprimée');
    }
}
