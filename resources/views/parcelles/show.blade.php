@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $parcelle->nom }}</h1>

    <p><strong>Superficie :</strong> {{ $parcelle->superficie }} ha</p>
    <p><strong>Latitude :</strong> {{ $parcelle->latitude }}</p>
    <p><strong>Longitude :</strong> {{ $parcelle->longitude }}</p>
    <p><strong>Contremaître :</strong> {{ $parcelle->contremaitre->utilisateur->nom ?? '-' }}</p>

    <h3>Cultures</h3>
    <ul>
        @forelse($parcelle->cultures as $culture)
            <li>{{ $culture->nom }} ({{ $culture->famille }})</li>
        @empty
            <li>Aucune culture enregistrée</li>
        @endforelse
    </ul>

    <h3>Diagnostics</h3>
    <ul>
        @forelse($parcelle->diagnostics as $diagnostic)
            <li>{{ $diagnostic->nom_maladie ?? 'Aucune maladie' }} — {{ $diagnostic->date_analyse }}</li>
        @empty
            <li>Aucun diagnostic enregistré</li>
        @endforelse
    </ul>

    <h3>Rotations</h3>
    <ul>
        @forelse($parcelle->rotations as $rotation)
            <li>{{ $rotation->status }} — proposée le {{ $rotation->date_proposition }}</li>
        @empty
            <li>Aucune rotation proposée</li>
        @endforelse
    </ul>

    <a href="{{ route('parcelles.index') }}">← Retour à la liste</a>
</div>
@endsection