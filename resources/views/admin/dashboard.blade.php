@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tableau de bord Administrateur</h1>
    <p>Bienvenue {{ auth()->user()->name }}</p>
</div>
@endsection