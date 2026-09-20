@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-title">
        <h1>Générer un rapport</h1>
    </div>

    <form class="form-card" action="{{ route('rapports.store') }}" method="POST">
        @csrf

        <label for="type">Type de rapport</label>
        <input type="text" id="type" name="type" value="{{ old('type') }}" placeholder="ex: mensuel, annuel, parcelles" required>
        @error('type') <span class="field-error">{{ $message }}</span> @enderror

        <label for="commentaire">Commentaire</label>
        <textarea id="commentaire" name="commentaire" rows="3">{{ old('commentaire') }}</textarea>
        @error('commentaire') <span class="field-error">{{ $message }}</span> @enderror

        <button type="submit" class="btn btn-primary">Générer</button>
    </form>
</div>
@endsection