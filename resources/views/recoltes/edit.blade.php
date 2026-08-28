@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la récolte</h1>

    <form action="{{ route('recoltes.update', $recolte) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Date de récolte</label>
        <input type="date" name="date_recolte" value="{{ old('date_recolte', $recolte->date_recolte) }}" required>

        <label>Quantité</label>
        <input type="number" step="0.01" name="quantite" value="{{ old('quantite', $recolte->quantite) }}" required>

        <label>Unité</label>
        <input type="text" name="unite" value="{{ old('unite', $recolte->unite) }}" required>

        <label>Contremaître</label>
        <select name="contremaitre_id" required>
            @foreach($contremaitres as $c)
                <option value="{{ $c->id }}" {{ $recolte->contremaitre_id == $c->id ? 'selected' : '' }}>{{ $c->utilisateur->nom ?? 'Contremaître #'.$c->id }}</option>
            @endforeach
        </select>

        <button type="submit">Enregistrer</button>
    </form>
</div>
@endsection