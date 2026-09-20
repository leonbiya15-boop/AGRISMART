<?php

namespace App\Http\Controllers;

use App\Models\{Diagnostic, Intrant, Parcelle, Recolte, Rotation};

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'parcelles' => Parcelle::count(),
            'superficie' => Parcelle::sum('superficie'),
            'recoltes' => Recolte::whereYear('date_recolte', now()->year)->sum('quantite'),
            'alertes' => Diagnostic::where('maladie_detectee', true)->count() + Intrant::whereColumn('quantite_stock', '<=', 'seuil_alerte')->count(),
            'diagnosticsRecents' => Diagnostic::with('parcelles')->latest('date_analyse')->take(4)->get(),
            'rotationsEnAttente' => Rotation::with('parcelles')->where('status', 'en attente')->latest('date_proposition')->take(4)->get(),
            'stocksFaibles' => Intrant::whereColumn('quantite_stock', '<=', 'seuil_alerte')->orderBy('quantite_stock')->take(4)->get(),
        ]);
    }
}
