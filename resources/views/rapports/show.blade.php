@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-title">
        <h1>Rapport du {{ $rapport->date_generation->format('d/m/Y H:i') }}</h1>
    </div>

    <div class="panel">
        <p><strong>Type :</strong> {{ $rapport->type }}</p>
        <p><strong>Généré par :</strong> {{ $rapport->administrateur->user->name ?? '-' }}</p>
        <p><strong>Commentaire :</strong> {{ $rapport->commentaire ?? 'Aucun' }}</p>
    </div>

    <a href="{{ route('rapports.index') }}" class="btn btn-secondary">← Retour à la liste</a>
</div>
@endsection