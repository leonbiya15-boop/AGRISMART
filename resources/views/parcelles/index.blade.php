<x-app-layout>
    <div class="container">
        <h1>Liste des parcelles</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('parcelles.create') }}" class="btn btn-primary">+ Nouvelle parcelle</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Superficie</th>
                    <th>Contremaître</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($parcelles as $parcelle)
                <tr>
                    <td>{{ $parcelle->nom }}</td>
                    <td>{{ $parcelle->superficie }} ha</td>
                    <td>{{ $parcelle->contremaitre->utilisateur->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('parcelles.show', $parcelle) }}">Voir</a>
                        <a href="{{ route('parcelles.edit', $parcelle) }}">Modifier</a>
                        @if(auth()->user()->administrateur ||
                            (auth()->user()->contremaitre && auth()->user()->contremaitre->id === $parcelle->contremaitre_id))

                            <form action="{{ route('parcelles.destroy', $parcelle) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer cette parcelle ?')">
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
</x-app-layout>