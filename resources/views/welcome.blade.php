<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgriSmart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="home-page">
    <header class="home-header">
        <a class="home-brand" href="{{ url('/') }}">
            
            <span>AgriSmart</span>
        </a>

        @if (Route::has('login'))
            <nav class="home-nav" aria-label="Navigation principale">
                @auth
                    <a class="home-nav-link" href="{{ url('/dashboard') }}">Tableau de bord</a>
                @else
                    <a class="home-nav-link.primary" href="{{ route('login') }}">Se connecter</a>
                    @if (Route::has('register'))
                        <a class="home-nav-link primary" href="{{ route('register') }}">Créer un compte</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main>
        <section class="home-hero">
            <div class="home-hero-copy">
                <p class="home-kicker">Agriculture intelligente au Cameroun</p>
                <h1>Suivre les parcelles, les cultures et les récoltes avec des données fiables.</h1>
                <p class="home-lead">
                    AgriSmart centralise la gestion agricole: parcelles géolocalisées, cultures, rotations,
                    diagnostics, récoltes, stocks d'intrants et alertes pour aider l'exploitant à décider plus vite.
                </p>
                <div class="home-actions">
                     @auth
                        <a class="home-btn primary" href="{{ url('/dashboard') }}">Ouvrir mon espace</a>
                    @else
                        <a class="home-btn primary" href="{{ route('register') }}">Commencer</a>
                        <a class="home-btn ghost" href="{{ route('login') }}">J'ai déjà un compte</a>
                    @endauth
                </div>
            </div>

            <div class="home-visual" aria-label="Aperçu AgriSmart">
                <div class="home-map-card">
                    <div class="map-topline">
                        <span>Parcelle cacao</span>
                        <strong>12.5 ha</strong>
                    </div>
                    <div class="map-field">
                        <span class="field-line line-a"></span>
                        <span class="field-line line-b"></span>
                        <span class="field-line line-c"></span>
                        <span class="field-pin"></span>
                    </div>
                </div>
                <div class="home-status-card disease">
                    <span>Diagnostic</span>
                    <strong>Risque faible</strong>
                </div>
                <div class="home-status-card stock">
                    <span>Intrants</span>
                    <strong>3 alertes</strong>
                </div>
            </div>
        </section>

        <section class="home-modules" aria-label="Modules principaux">
            <article>
                <span class="module-icon">01</span>
                <h2>Parcelles</h2>
                <p>Localisation, superficie, responsable et état de chaque exploitation.</p>
            </article>
            <article>
                <span class="module-icon">02</span>
                <h2>Récoltes</h2>
                <p>Historique des quantités produites pour mieux suivre le rendement.</p>
            </article>
            <article>
                <span class="module-icon">03</span>
                <h2>Diagnostics</h2>
                <p>Analyse des maladies et recommandations pour réagir rapidement.</p>
            </article>
            <article>
                <span class="module-icon">04</span>
                <h2>Stocks</h2>
                <p>Suivi des intrants et détection des niveaux faibles avant rupture.</p>
            </article>
        </section>
                <section class="cultures-section" aria-label="Nos principales cultures">
            <div class="cultures-heading">
                <h2>Découvrez quelques de nos cultures</h2>
                <p>Quelques  cultures suivies par les exploitants sur AgriSmart.</p>
            </div>
            <div class="cultures-grid">
                <article class="culture-card">
                    <div class="culture-card-img">
                        <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Corn%20field%20in%20Mexico.jpg?width=400" alt="Champ de maïs" loading="lazy">
                    </div>
                    <span>🌽 Maïs</span>
                </article>
                <article class="culture-card">
                    <div class="culture-card-img">
                        <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Champs%20de%20macabo.jpg?width=400" alt="Champ de macabo" loading="lazy">
                    </div>
                    <span>🌿 Macabo</span>
                </article>
                <article class="culture-card">
                    <div class="culture-card-img">
                        <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Peanuts%20(Arachis%20hypogaea)%20-%20in%20shell,%20shell%20cracked%20open,%20shelled,%20peeled.jpg?width=400" alt="Arachides" loading="lazy">
                    </div>
                    <span>🥜 Arachide</span>
                </article>
                <article class="culture-card">
                    <div class="culture-card-img">
                        <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Cassava%20plant.jpg?width=400" alt="Plant de manioc" loading="lazy">
                    </div>
                    <span>🌱 Manioc</span>
                </article>
                <article class="culture-card">
                    <div class="culture-card-img">
                        <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Cacao%20pods.jpg?width=400" alt="Cabosses de cacao" loading="lazy">
                    </div>
                    <span>🍫 Cacao</span>
                </article>
                <article class="culture-card">
                    <div class="culture-card-img">
                        <img src="https://commons.wikimedia.org/wiki/Special:FilePath/A%20bunch%20of%20bananas.jpg?width=400" alt="Régime de bananes" loading="lazy">
                    </div>
                    <span>🍌 Banane</span>
                </article>
                <article class="culture-card">
                    <div class="culture-card-img">
                        <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Date%20palm%20with%20fruits.jpg?width=400" alt="Dattes sur palmier" loading="lazy">
                    </div>
                    <span>🌴 Dattes</span>
                </article>
                <article class="culture-card">
                    <div class="culture-card-img">
                        <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Four%20Different%20Varieties%20of%20Green%20Beans%20(Phaseolus%20vulgaris).jpg?width=400" alt="Haricots verts" loading="lazy">
                    </div>
                    <span>🫘 Haricot</span>
                </article>
            </div>
        </section>
                    </div>
        </section>
    </main>

    <footer class="agri-footer">
        <div class="agri-footer-container">
            <div class="agri-footer-column">
                <h3>AgriSmart</h3>
                <p>Plateforme intelligente de gestion des exploitations agricoles.</p>
            </div>

            <div class="agri-footer-column">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li><a href="#fonctionnalites">Parcelles</a></li>
                    <li><a href="#fonctionnalites">Cultures</a></li>
                    <li><a href="#fonctionnalites">Récoltes</a></li>
                    <li><a href="#fonctionnalites">Diagnostics</a></li>
                </ul>
            </div>

            <div class="agri-footer-column">
                <h4>À propos</h4>
                <p>Une solution intelligente pour faciliter la gestion et le suivi des exploitations agricoles.</p>
            </div>

            <div class="agri-footer-column">
                <h4>Contact</h4>
                <ul>
                    <li>contact@agrismart.com</li>
                    <li>+237 6 93723130/692850464</li>
                    <li>Douala, Cameroun</li>
                </ul>
            </div>
        </div>

        <div class="agri-footer-bottom">
            © {{ date('Y') }} AgriSmart — Tous droits réservés.
        </div>
    </footer>
    </main>
</body>
</html>
