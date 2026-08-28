@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la rotation</h1>

    <form action="{{ route('rotations.update', $rotation) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Date de proposition</label>
        <input type="date" name="date_proposition" value="{{ old('date_proposition', $rotation->date_proposition) }}" required>

        <label>Statut</label>
        <input type="text" name="status" value="{{ old('status', $rotation->status) }}" required>

        <label>Parcelles concernées</label>
        @foreach($parcelles as $p)
            <label>
                <input type="checkbox" name="parcelles[]" value="{{ $p->id }}"
                    {{ $rotation->parcelles->contains($p->id) ? 'checked' : '' }}>
                {{ $p->nom }}
            </label>
        @endforeach

        <button type="submit">Enregistrer</button>
    </form>
</div>
@endsection