@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des cultures</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('cultures.create') }}" class="btn btn-primary">+ Nouvelle culture</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Famille</th>
                <th>Parcelle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cultures as $culture)
            <tr>
                <td>{{ $culture->nom }}</td>
                <td>{{ $culture->famille }}</td>
                <td>{{ $culture->parcelle->nom ?? '-' }}</td>
                <td>
                    <a href="{{ route('cultures.show', $culture) }}">Voir</a>
                    <a href="{{ route('cultures.edit', $culture) }}">Modifier</a>
                    <form action="{{ route('cultures.destroy', $culture) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Supprimer cette culture ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection