@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-title">
        <div>
            <p class="eyebrow">Administration</p>
            <h1>Stocks</h1>
        </div>
        <a href="{{ route('stocks.create') }}" class="btn btn-primary">+ Nouveau stock</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Quantité totale</th>
                    <th>Dernière mise à jour</th>
                    <th>Administrateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $stock)
                <tr>
                    <td>{{ $stock->quantite_totale }}</td>
                    <td>{{ $stock->date_mise_a_jour }}</td>
                    <td>{{ $stock->administrateur->user->name ?? '-' }}</td>
                    <td class="actions">
                        <a href="{{ route('stocks.show', $stock) }}">Voir</a>
                        <a href="{{ route('stocks.edit', $stock) }}">Modifier</a>
                        <form action="{{ route('stocks.destroy', $stock) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ce stock ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="empty">Aucun stock enregistré</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection