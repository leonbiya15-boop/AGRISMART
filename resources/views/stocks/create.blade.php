@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-title">
        <h1>Enregistrer un stock</h1>
    </div>

    <form class="form-card" action="{{ route('stocks.store') }}" method="POST">
        @csrf

        <label for="quantite_totale">Quantité totale</label>
        <input type="number" step="0.01" id="quantite_totale" name="quantite_totale" value="{{ old('quantite_totale') }}" required>
        @error('quantite_totale') <span class="field-error">{{ $message }}</span> @enderror

        <input type="hidden" name="administrateur_id" value="{{ auth()->id() }}">
       <label for="commentaire">Commentaire</label>
<textarea id="commentaire" name="commentaire" rows="3">{{ old('commentaire', $stock->commentaire ?? '') }}</textarea>
@error('commentaire') <span class="field-error">{{ $message }}</span> @enderror
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection