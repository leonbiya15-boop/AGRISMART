@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Enregistrer une récolte</h1>

    <form action="{{ route('recoltes.store') }}" method="POST">
        @csrf

        <label>Date de récolte</label>
        <input type="date" name="date_recolte" value="{{ old('date_recolte') }}" required>

        <label>Quantité</label>
        <input type="number" step="0.01" name="quantite" value="{{ old('quantite') }}" required>

        <label>Unité</label>
        <input type="text" name="unite" value="{{ old('unite') }}" required>

        <label>Contremaître</label>
        <select name="contremaitre_id" required>
            @foreach($contremaitres as $c)
                <option value="{{ $c->id }}">{{ $c->utilisateur->nom ?? 'Contremaître #'.$c->id }}</option>
            @endforeach
        </select>

        <button type="submit">Enregistrer</button>
    </form>
</div>
@endsection