<?php

namespace App\Http\Controllers;

use App\Models\Rotation;
use App\Models\Parcelle;
use App\Services\IAService;
use Illuminate\Http\Request;

class RotationController extends Controller
{
    public function index()
    {
        $rotations = Rotation::with('parcelles')->get();
        return view('rotations.index', compact('rotations'));
    }

    public function create(Request $request, IAService $ia)
    {
        $parcelles = Parcelle::all();
        $propositionIA = null;
        $parcelleSelectionnee = null;

        if ($request->filled('parcelle_id')) {
            $parcelleSelectionnee = Parcelle::with('cultures')->find($request->parcelle_id);

            if ($parcelleSelectionnee) {
                $historique = $parcelleSelectionnee->cultures->pluck('nom')->implode(', ');
                $historique = $historique ?: 'aucune culture enregistrée sur cette parcelle';

                $propositionIA = $ia->proposerRotation($historique);
            }
        }

        return view('rotations.create', compact('parcelles', 'propositionIA', 'parcelleSelectionnee'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parcelle_id' => 'required|exists:parcelles,id',
            'culture_proposee' => 'required|string|max:255',
            'origine' => 'required|in:ia,manuelle',
        ]);

        $rotation = Rotation::create([
            'date_proposition' => now(),
            'status' => 'validée',
            'culture_proposee' => $validated['culture_proposee'],
            'origine' => $validated['origine'],
        ]);

        $rotation->parcelles()->sync([$validated['parcelle_id']]);

        return redirect()->route('rotations.index')->with('success', 'Rotation enregistrée avec succès');
    }

    public function show(Rotation $rotation)
    {
        $rotation->load('parcelles');
        return view('rotations.show', compact('rotation'));
    }

    public function edit(Rotation $rotation)
    {
        $parcelles = Parcelle::all();
        $rotation->load('parcelles');
        return view('rotations.edit', compact('rotation', 'parcelles'));
    }

    public function update(Request $request, Rotation $rotation)
    {
        $validated = $request->validate([
            'date_proposition' => 'required|date',
            'status' => 'required|string',
            'parcelles' => 'required|array',
            'parcelles.*' => 'exists:parcelles,id',
        ]);

        $rotation->update($validated);
        $rotation->parcelles()->sync($validated['parcelles']);

        return redirect()->route('rotations.index')->with('success', 'Rotation mise à jour');
    }

    public function destroy(Rotation $rotation)
    {
       $user = request()->user();

        if ($user->administrateur) {
            $rotation->parcelles()->detach();
            $rotation->delete();

            return redirect()
                ->route('rotations.index')
                ->with('success', 'Rotation supprimée avec succès.');
        }

        $contremaitre = $user->contremaitre;

        if (!$contremaitre) {
            abort(403, 'Accès non autorisé.');
        }

        $rotation->load('parcelles');

        foreach ($rotation->parcelles as $parcelle) {
            if ($parcelle->contremaitre_id !== $contremaitre->id) {
                abort(403, 'Vous ne pouvez pas supprimer cette rotation.');
            }
        }

        $rotation->parcelles()->detach();
        $rotation->delete();

        return redirect()
            ->route('rotations.index')
            ->with('success', 'Rotation supprimée avec succès.');
    }
}