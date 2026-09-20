@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-title">
        <h1>Modifier le rapport</h1>
    </div>

    <form class="form-card" action="{{ route('rapports.update', $rapport) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="type">Type de rapport</label>
        <input type="text" id="type" name="type" value="{{ old('type', $rapport->type) }}" required>
        @error('type') <span class="field-error">{{ $message }}</span> @enderror

        <label for="commentaire">Commentaire</label>
        <textarea id="commentaire" name="commentaire" rows="3">{{ old('commentaire', $rapport->commentaire) }}</textarea>
        @error('commentaire') <span class="field-error">{{ $message }}</span> @enderror

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection