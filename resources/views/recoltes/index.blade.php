@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des récoltes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('recoltes.create') }}" class="btn btn-primary">+ Nouvelle récolte</a>

    <table class="table">
        <thead>
                       <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Quantité</th>
                <th>Unité</th>
                <th>Contremaître</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recoltes as $recolte)
            <tr>
                <td>{{ $recolte->nom }}</td>
                <td>{{ $recolte->date_recolte }}</td>
                <td>{{ $recolte->quantite }}</td>
                <td>{{ $recolte->unite }}</td>
                <td>{{ $recolte->contremaitre->utilisateur->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('recoltes.show', $recolte) }}">Voir</a>
                    <a href="{{ route('recoltes.edit', $recolte) }}">Modifier</a>
                  @if(
    auth()->user()->administrateur ||
    (
        auth()->user()->contremaitre &&
        $recolte->contremaitre_id === auth()->user()->contremaitre->id
    )
)
    <form action="{{ route('recoltes.destroy', $recolte) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Supprimer cette récolte ?')">
            Supprimer
        </button>
    </form>
@endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection