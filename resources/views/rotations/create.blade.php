@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Proposer une rotation</h1>

    <form action="{{ route('rotations.store') }}" method="POST">
        @csrf

        <label>Date de proposition</label>
        <input type="date" name="date_proposition" value="{{ old('date_proposition') }}" required>

        <label>Statut</label>
        <input type="text" name="status" value="{{ old('status') }}" required placeholder="ex: en attente, validée, refusée">

        <label>Parcelles concernées</label>
        @foreach($parcelles as $p)
            <label>
                <input type="checkbox" name="parcelles[]" value="{{ $p->id }}">
                {{ $p->nom }}
            </label>
        @endforeach

        <button type="submit">Enregistrer</button>
    </form>
</div>
@endsection