@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un diagnostic</h1>

    <form action="{{ route('diagnostics.store') }}" method="POST">
        @csrf

        <label>Maladie détectée ?</label>
        <select name="maladie_detectee" required>
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>

        <label>Nom de la maladie</label>
        <input type="text" name="nom_maladie" value="{{ old('nom_maladie') }}">

        <label>Date d'analyse</label>
        <input type="date" name="date_analyse" value="{{ old('date_analyse') }}" required>

        <label>Niveau de confiance (%)</label>
        <input type="number" step="0.01" name="niveau_confiance" value="{{ old('niveau_confiance') }}" required>

        <label>Parcelles concernées</label>
        @foreach($parcelles as $p)
            <label>
                <input type="checkbox" name="parcelles[]" value="{{ $p->id }}">
                {{ $p->nom }}
            </label>
        @endforeach

        <button type="submit">Enregistrer</button>
    </form>
</div>
@endsection