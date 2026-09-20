<header class="site-header">
 <a class="brand" href="{{ route('dashboard') }}">
    <img src="{{ asset('images/EKDM1579.PNG') }}" alt="AgriSmart" style="height: 32px; width: auto;">
    AgriSmart
</a>
 <button class="menu-toggle" type="button" aria-label="Ouvrir le menu" data-menu-toggle>☰</button>
 <nav class="site-nav" data-menu>
  <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Tableau de bord</a><a class="{{ request()->routeIs('parcelles.*') ? 'active' : '' }}" href="{{ route('parcelles.index') }}">Parcelles</a><a class="{{ request()->routeIs('cultures.*') ? 'active' : '' }}" href="{{ route('cultures.index') }}">Cultures</a><a class="{{ request()->routeIs('recoltes.*') ? 'active' : '' }}" href="{{ route('recoltes.index') }}">Récoltes</a><a class="{{ request()->routeIs('rotations.*') ? 'active' : '' }}" href="{{ route('rotations.index') }}">Rotations</a><a class="{{ request()->routeIs('diagnostics.*') ? 'active' : '' }}" href="{{ route('diagnostics.index') }}">Diagnostics</a><a class="{{ request()->routeIs('intrants.*') ? 'active' : '' }}" href="{{ route('intrants.index') }}">Intrants</a>
  <a href="{{ route('alertes.index') }}" class="{{ request()->routeIs('alertes.*') ? 'active' : '' }}">Alertes</a>
  @if(auth()->user()->administrateur)<a class="{{ request()->routeIs('rapports.*') ? 'active' : '' }}" href="{{ route('rapports.index') }}">Rapports</a><a class="{{ request()->routeIs('stocks.*') ? 'active' : '' }}" href="{{ route('stocks.index') }}">Stocks</a><a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Utilisateurs</a>@endif
 </nav>
 <div class="user-menu"><a href="{{ route('profile.edit') }}">{{ auth()->user()->name }}</a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Déconnexion</button></form></div>
</header>