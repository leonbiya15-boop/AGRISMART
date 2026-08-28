@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des rotations</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('rotations.create') }}" class="btn btn-primary">+ Nouvelle rotation</a>

    <table class="table">
        <thead>
            <tr>
                <th>Date proposition</th>
                <th>Statut</th>
                <th>Parcelles concernées</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rotations as $rotation)
            <tr>
                <td>{{ $rotation->date_proposition }}</td>
                <td>{{ $rotation->status }}</td>
                <td>{{ $rotation->parcelles->pluck('nom')->join(', ') }}</td>
                <td>
                    <a href="{{ route('rotations.show', $rotation) }}">Voir</a>
                    <a href="{{ route('rotations.edit', $rotation) }}">Modifier</a>
                    <form action="{{ route('rotations.destroy', $rotation) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Supprimer cette rotation ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection