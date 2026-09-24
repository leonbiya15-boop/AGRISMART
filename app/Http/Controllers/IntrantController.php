<?php

namespace App\Http\Controllers;

use App\Models\Intrant;
use Illuminate\Http\Request;

class IntrantController extends Controller
{
    public function index()
    {
        return view('intrants.index', ['intrants' => Intrant::orderBy('categorie')->orderBy('nom')->get()]);
    }

    public function create()
    {
        $this->authorize('create', Intrant::class);

        return view('intrants.form', ['intrant' => new Intrant(), 'action' => route('intrants.store'), 'method' => 'POST']);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Intrant::class);

        Intrant::create($this->validated($request));
        return redirect()->route('intrants.index')->with('success', 'Intrant ajouté au stock.');
    }

    public function edit(Intrant $intrant)
    {
        $this->authorize('update', $intrant);

        return view('intrants.form', ['intrant' => $intrant, 'action' => route('intrants.update', $intrant), 'method' => 'PUT']);
    }

    public function update(Request $request, Intrant $intrant)
    {
        $this->authorize('update', $intrant);

        $intrant->update($this->validated($request));
        return redirect()->route('intrants.index')->with('success', 'Intrant mis à jour.');
    }

    public function destroy(Intrant $intrant)
    {
        $this->authorize('delete', $intrant);

        $intrant->delete();
        return redirect()->route('intrants.index')->with('success', 'Intrant supprimé.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nom' => 'required|string|max:120',
            'categorie' => 'required|string|max:80',
            'quantite_stock' => 'required|numeric|min:0',
            'unite' => 'required|string|max:20',
            'seuil_alerte' => 'required|numeric|min:0',
            'prix_unitaire' => 'nullable|numeric|min:0',
        ]);
    }
}