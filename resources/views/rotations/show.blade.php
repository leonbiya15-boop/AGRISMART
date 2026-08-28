@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rotation du {{ $rotation->date_proposition }}</h1>

    <p><strong>Statut :</strong> {{ $rotation->status }}</p>

    <h3>Parcelles concernées</h3>
    <ul>
        @forelse($rotation->parcelles as $parcelle)
            <li>{{ $parcelle->nom }}</li>
        @empty
            <li>Aucune parcelle</li>
        @endforelse
    </ul>

    <a href="{{ route('rotations.index') }}">← Retour à la liste</a>
</div>
@endsection