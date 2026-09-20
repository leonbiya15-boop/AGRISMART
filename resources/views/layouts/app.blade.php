<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"><title>{{ config('app.name', 'AgriSmart') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="agrismart-page">
    @include('layouts.navigation')
    <main class="main-content">
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif
        @if($errors->any()) <div class="alert alert-error"><strong>Veuillez corriger les champs indiqués.</strong></div> @endif
        @isset($header)<div class="page-heading">{{ $header }}</div>@endisset
        @isset($slot){{ $slot }}@else @yield('content') @endisset
    </main>
</body>
</html>