@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $culture->nom }}</h1>

    <p><strong>Famille :</strong> {{ $culture->famille }}</p>
    <p><strong>Parcelle :</strong> {{ $culture->parcelle->nom ?? '-' }}</p>

    <a href="{{ route('cultures.index') }}">← Retour à la liste</a>
</div>
@endsection