@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Diagnostic du {{ $diagnostic->date_analyse }}</h1>

    <p><strong>Maladie détectée :</strong> {{ $diagnostic->maladie_detectee ? 'Oui' : 'Non' }}</p>
    <p><strong>Nom maladie :</strong> {{ $diagnostic->nom_maladie ?? '-' }}</p>
    <p><strong>Niveau de confiance :</strong> {{ $diagnostic->niveau_confiance }}%</p>

    <h3>Parcelles concernées</h3>
    <ul>
        @forelse($diagnostic->parcelles as $parcelle)
            <li>{{ $parcelle->nom }}</li>
        @empty
            <li>Aucune parcelle</li>
        @endforelse
    </ul>

    <a href="{{ route('diagnostics.index') }}">← Retour à la liste</a>
</div>
@endsection