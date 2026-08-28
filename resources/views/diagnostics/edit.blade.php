@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le diagnostic</h1>

    <form action="{{ route('diagnostics.update', $diagnostic) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Maladie détectée ?</label>
        <select name="maladie_detectee" required>
            <option value="1" {{ $diagnostic->maladie_detectee ? 'selected' : '' }}>Oui</option>
            <option value="0" {{ !$diagnostic->maladie_detectee ? 'selected' : '' }}>Non</option>
        </select>

        <label>Nom de la maladie</label>
        <input type="text" name="nom_maladie" value="{{ old('nom_maladie', $diagnostic->nom_maladie) }}">

        <label>Date d'analyse</label>
        <input type="date" name="date_analyse" value="{{ old('date_analyse', $diagnostic->date_analyse) }}" required>

        <label>Niveau de confiance (%)</label>
        <input type="number" step="0.01" name="niveau_confiance" value="{{ old('niveau_confiance', $diagnostic->niveau_confiance) }}" required>

        <label>Parcelles concernées</label>
        @foreach($parcelles as $p)
            <label>
                <input type="checkbox" name="parcelles[]" value="{{ $p->id }}"
                    {{ $diagnostic->parcelles->contains($p->id) ? 'checked' : '' }}>
                {{ $p->nom }}
            </label>
        @endforeach

        <button type="submit">Enregistrer</button>
    </form>
</div>
@endsection