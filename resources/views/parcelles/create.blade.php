@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer une parcelle</h1>

    <form action="{{ route('parcelles.store') }}" method="POST">
        @csrf

        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom') }}" required>

        <label>Superficie (ha)</label>
        <input type="number" step="0.01" name="superficie" value="{{ old('superficie') }}" required>

        <label>Latitude</label>
        <input type="number" step="0.000001" name="latitude" value="{{ old('latitude') }}" required>

        <label>Longitude</label>
        <input type="number" step="0.000001" name="longitude" value="{{ old('longitude') }}" required>

        <label>Contremaître</label>
        <select name="contremaitre_id" required>
            @foreach($contremaitres as $c)
                <option value="{{ $c->id }}">{{ $c->utilisateur->nom ?? 'Contremaître #'.$c->id }}</option>
            @endforeach
        </select>

        <button type="submit">Créer</button>
    </form>
</div>
@endsection