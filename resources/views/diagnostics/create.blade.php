@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Analyser une photo (détection IA)</h1>

    <form action="{{ route('diagnostics.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Photo de la plante</label>
        <input type="file" name="photo" accept="image/*" required>
        @error('photo') <span class="field-error">{{ $message }}</span> @enderror

        <label>Parcelles concernées</label>
        @foreach($parcelles as $p)
            <label>
                <input type="checkbox" name="parcelles[]" value="{{ $p->id }}">
                {{ $p->nom }}
            </label>
        @endforeach
        @error('parcelles') <span class="field-error">{{ $message }}</span> @enderror

        <button type="submit">Analyser avec l'IA</button>
    </form>
</div>
@endsection