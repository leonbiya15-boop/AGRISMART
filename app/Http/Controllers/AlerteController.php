<?php

namespace App\Http\Controllers;

use App\Models\Alerte;
use Illuminate\Http\Request;

class AlerteController extends Controller
{
    public function index()
    {
        $alertes = Alerte::with(['diagnostic', 'parcelle'])->latest()->get();
        return view('alertes.index', compact('alertes'));
    }

    public function update(Request $request, Alerte $alerte)
    {
        $alerte->update(['statut' => 'traitee']);
        return redirect()->route('alertes.index')->with('success', 'Alerte marquée comme traitée');
    }

    public function destroy(Alerte $alerte)
    {
        $alerte->delete();
        return redirect()->route('alertes.index')->with('success', 'Alerte supprimée');
    }
}