@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer une culture</h1>

    <form action="{{ route('cultures.store') }}" method="POST">
        @csrf

        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom') }}" required>

        <label>Famille</label>
        <input type="text" name="famille" value="{{ old('famille') }}" required>

        <label>Parcelle</label>
        <select name="parcelle_id" required>
            @foreach($parcelles as $p)
                <option value="{{ $p->id }}">{{ $p->nom }}</option>
            @endforeach
        </select>

        <button type="submit">Créer</button>
    </form>
</div>
@endsection