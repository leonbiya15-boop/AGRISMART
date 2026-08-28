@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Récolte du {{ $recolte->date_recolte }}</h1>

    <p><strong>Quantité :</strong> {{ $recolte->quantite }} {{ $recolte->unite }}</p>
    <p><strong>Contremaître :</strong> {{ $recolte->contremaitre->utilisateur->nom ?? '-' }}</p>

    <a href="{{ route('recoltes.index') }}">← Retour à la liste</a>
</div>
@endsection