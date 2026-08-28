@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des diagnostics</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('diagnostics.create') }}" class="btn btn-primary">+ Nouveau diagnostic</a>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Maladie détectée</th>
                <th>Nom maladie</th>
                <th>Confiance</th>
                <th>Parcelles concernées</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($diagnostics as $diagnostic)
            <tr>
                <td>{{ $diagnostic->date_analyse }}</td>
                <td>{{ $diagnostic->maladie_detectee ? 'Oui' : 'Non' }}</td>
                <td>{{ $diagnostic->nom_maladie ?? '-' }}</td>
                <td>{{ $diagnostic->niveau_confiance }}%</td>
                <td>{{ $diagnostic->parcelles->pluck('nom')->join(', ') }}</td>
                <td>
                    <a href="{{ route('diagnostics.show', $diagnostic) }}">Voir</a>
                    <a href="{{ route('diagnostics.edit', $diagnostic) }}">Modifier</a>
                    <form action="{{ route('diagnostics.destroy', $diagnostic) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Supprimer ce diagnostic ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection