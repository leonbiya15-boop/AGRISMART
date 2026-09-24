@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Planifier une rotation</h1>

    <form action="{{ route('rotations.create') }}" method="GET">
        <label>Choisir une parcelle</label>
        <select name="parcelle_id" onchange="this.form.submit()" required>
            <option value="">-- Sélectionner --</option>
            @foreach($parcelles as $p)
                <option value="{{ $p->id }}" {{ $parcelleSelectionnee && $parcelleSelectionnee->id == $p->id ? 'selected' : '' }}>
                    {{ $p->nom }}
                </option>
            @endforeach
        </select>
    </form>

    @if($parcelleSelectionnee)
        <hr>

        @if($propositionIA && $propositionIA['culture_proposee'])
            <div class="alert alert-success">
                <strong>Proposition de l'IA :</strong> {{ $propositionIA['culture_proposee'] }}
                @if(!empty($propositionIA['raison']))
                    <p>{{ $propositionIA['raison'] }}</p>
                @endif
            </div>

            <form action="{{ route('rotations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="parcelle_id" value="{{ $parcelleSelectionnee->id }}">
                <input type="hidden" name="culture_proposee" value="{{ $propositionIA['culture_proposee'] }}">
                <input type="hidden" name="origine" value="ia">
                <button type="submit"> Accepter cette proposition</button>
            </form>

            <p>Cette proposition ne vous convient pas ?</p>
        @else
            <div class="alert alert-warning">
                L'IA n'est pas disponible pour le moment. Vous pouvez entrer votre rotation manuellement.
            </div>
        @endif

        <form action="{{ route('rotations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="parcelle_id" value="{{ $parcelleSelectionnee->id }}">
            <input type="hidden" name="origine" value="manuelle">

            <label>Entrer votre propre culture de rotation</label>
            <input type="text" name="culture_proposee" placeholder="ex: Maïs, Manioc, Arachide..." required>

            <button type="submit">Enregistrer ma rotation</button>
        </form>
    @endif
</div>
@endsection