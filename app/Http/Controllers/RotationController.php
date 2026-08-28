<?php

namespace App\Http\Controllers;

use App\Models\Rotation;
use App\Models\Parcelle;
use Illuminate\Http\Request;

class RotationController extends Controller
{
    public function index()
    {
        $rotations = Rotation::with('parcelles')->get();
        return view('rotations.index', compact('rotations'));
    }

    public function create()
    {
        $parcelles = Parcelle::all();
        return view('rotations.create', compact('parcelles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_proposition' => 'required|date',
            'status' => 'required|string',
            'parcelles' => 'required|array',
            'parcelles.*' => 'exists:parcelles,id',
        ]);

        $rotation = Rotation::create($validated);
        $rotation->parcelles()->sync($validated['parcelles']);

        return redirect()->route('rotations.index')->with('success', 'Rotation proposée avec succès');
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
        $rotation->delete();
        return redirect()->route('rotations.index')->with('success', 'Rotation supprimée');
    }
}