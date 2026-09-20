<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Afficher la liste des stocks.
     */
    public function index()
    {
        $stocks = Stock::with('administrateur')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('stocks.index', compact('stocks'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('stocks.create');
    }

    /**
     * Enregistrer un nouveau stock.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantite_totale' => 'required|numeric|min:0',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        Stock::create([
            'quantite_totale' => $request->quantite_totale,
            'date_mise_a_jour' => now(),
            'administrateur_id' => request()->user()->id,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Stock enregistré avec succès.');
    }

    /**
     * Afficher un stock.
     */
    public function show(Stock $stock)
    {
        $stock->load('administrateur');

        return view('stocks.show', compact('stock'));
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }

    /**
     * Modifier un stock.
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'quantite_totale' => 'required|numeric|min:0',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $stock->update([
            'quantite_totale' => $request->quantite_totale,
            'date_mise_a_jour' => now(),
            'commentaire' => $request->commentaire,
        ]);

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Stock modifié avec succès.');
    }

    /**
     * Supprimer un stock.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Stock supprimé avec succès.');
    }
}