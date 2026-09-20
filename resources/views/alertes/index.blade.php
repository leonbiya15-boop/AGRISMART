@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alertes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Message</th>
                <th>Parcelle</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alertes as $alerte)
            <tr>
                <td>{{ $alerte->message }}</td>
                <td>{{ $alerte->parcelle->nom ?? '-' }}</td>
                <td>
                    <span class="badge {{ $alerte->statut === 'nouvelle' ? 'danger' : 'success' }}">
                        {{ $alerte->statut === 'nouvelle' ? 'Nouvelle' : 'Traitée' }}
                    </span>
                </td>
                <td>{{ $alerte->created_at->format('d/m/Y H:i') }}</td>
                <td class="actions">
                    @if($alerte->statut === 'nouvelle')
                    <form action="{{ route('alertes.update', $alerte) }}" method="POST" style="display:inline">
                        @csrf
                        @method('PUT')
                        <button type="submit">Marquer comme traitée</button>
                    </form>
                    @endif
                    <form action="{{ route('alertes.destroy', $alerte) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Supprimer cette alerte ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="empty">Aucune alerte pour le moment.</td></tr>
            @endforelse
        </tbody>
    </table>

    @if($alertes->where('statut', 'nouvelle')->count() > 0)
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const messages = @json($alertes->where('statut', 'nouvelle')->pluck('message')->values());

        if ('speechSynthesis' in window && messages.length > 0) {
            const texte = messages.length === 1
                ? messages[0]
                : `Vous avez ${messages.length} nouvelles alertes. ` + messages.join('. ');

            const utterance = new SpeechSynthesisUtterance(texte);
            utterance.lang = 'fr-FR';
            utterance.rate = 0.95;

            window.speechSynthesis.speak(utterance);
        }
    });
    </script>
    @endif
</div>
@endsection