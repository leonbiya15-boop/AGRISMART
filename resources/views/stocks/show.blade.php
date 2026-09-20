@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-title">
        <h1>Stock du {{ $stock->date_mise_a_jour->format('d/m/Y H:i') }}</h1>
    </div>

    <div class="panel">
        <p><strong>Quantité totale :</strong> {{ $stock->quantite_totale }}</p>
        <p><strong>Généré par :</strong> {{ $stock->administrateur->user->name ?? '-' }}</p>
        <p><strong>Commentaire :</strong> {{ $stock->commentaire ?? 'Aucun' }}</p>
    </div>

    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">← Retour à la liste</a>
</div>
@endsection