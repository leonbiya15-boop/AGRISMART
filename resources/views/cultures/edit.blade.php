@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la culture</h1>

    <form action="{{ route('cultures.update', $culture) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $culture->nom) }}" required>

        <label>Famille</label>
        <input type="text" name="famille" value="{{ old('famille', $culture->famille) }}" required>

        <label>Parcelle</label>
        <select name="parcelle_id" required>
            @foreach($parcelles as $p)
                <option value="{{ $p->id }}" {{ $culture->parcelle_id == $p->id ? 'selected' : '' }}>{{ $p->nom }}</option>
            @endforeach
        </select>

        <button type="submit">Enregistrer</button>
    </form>
</div>
@endsection