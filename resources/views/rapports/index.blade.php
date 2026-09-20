@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-title">
        <div>
            <p class="eyebrow">Administration</p>
            <h1>Rapports</h1>
        </div>
        <a href="{{ route('rapports.create') }}" class="btn btn-primary">+ Nouveau rapport</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Date de génération</th>
                    <th>Type</th>
                    <th>Administrateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rapports as $rapport)
                <tr>
                    <td>{{ $rapport->date_generation->format('d/m/Y H:i') }}</td>
                    <td>{{ $rapport->type }}</td>
                    <td>{{ $rapport->administrateur->user->name ?? '-' }}</td>
                                     <td class="actions">
                        <a href="{{ route('rapports.show', $rapport) }}">Voir</a>
                        <a href="{{ route('rapports.edit', $rapport) }}">Modifier</a>
                        <form action="{{ route('rapports.destroy', $rapport) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ce rapport ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="empty">Aucun rapport généré</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection