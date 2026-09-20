@extends('layouts.app')

@section('content')
<div class="container">
        <h1>{{ $recolte->nom }}</h1>
    <p><strong>Date :</strong> {{ $recolte->date_recolte }}</p>

    <p><strong>Quantité :</strong> {{ $recolte->quantite }} {{ $recolte->unite }}</p>
    <p><strong>Contremaître :</strong> {{ $recolte->contremaitre->utilisateur->name ?? '-' }}</p>

    <a href="{{ route('recoltes.index') }}">← Retour à la liste</a>
</div>
@endsection