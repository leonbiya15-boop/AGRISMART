@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la parcelle</h1>

    <form action="{{ route('parcelles.update', $parcelle) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $parcelle->nom) }}" required>

        <label>Superficie (ha)</label>
        <input type="number" step="0.01" name="superficie" value="{{ old('superficie', $parcelle->superficie) }}" required>

        <label>Latitude</label>
        <input type="number" step="0.000001" name="latitude" value="{{ old('latitude', $parcelle->latitude) }}" required>

        <label>Longitude</label>
        <input type="number" step="0.000001" name="longitude" value="{{ old('longitude', $parcelle->longitude) }}" required>

        <button type="submit">Enregistrer</button>
    </form>
</div>
@endsection