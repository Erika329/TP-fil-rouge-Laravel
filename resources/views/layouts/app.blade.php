<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Application de gestion de ticketing' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="body-dash {{ $role ?? 'role-collaborateur' }}">
    <header>
        <div class="tableau_de_bord">
            <h1>{{ $title ?? 'Tableau de bord' }}</h1>

            <nav class="Navigation_principale">
                <ul>
@if(isset($role) && $role === 'role-admin')
                        <li><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li><a href="{{ route('users.index') }}">Utilisateurs</a></li>
                        <li><a href="{{ route('legacy.clients-admin') }}">Clients</a></li>
                        <li><a href="{{ route('projects.index') }}">Projets</a></li>
                        <li><a href="{{ route('tickets.index') }}">Tickets</a></li>
                        <li><a href="{{ route('projects.index') }}">Contrats</a></li>
                        <li><a href="{{ route('settings.show') }}">Parametres</a></li>
                    @elseif(isset($role) && $role === 'role-client')
                        <li><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li><a href="{{ route('projects.index') }}">Projets</a></li>
                        <li><a href="{{ route('tickets.index') }}">Tickets</a></li>
                        <li><a href="{{ route('profile.show') }}">Profil</a></li>
                        <li><a href="{{ route('settings.show') }}">Parametres</a></li>
                    @else
                        <li><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li><a href="{{ route('projects.index') }}">Projets</a></li>
                        <li><a href="{{ route('tickets.index') }}">Tickets</a></li>
                        <li><a href="{{ route('tickets.create') }}">Creer un ticket</a></li>
<li><a href="{{ route('clients.index') }}">Clients</a></li>
                        <li><a href="{{ route('profile.show') }}">Profil</a></li>
                        <li><a href="{{ route('settings.show') }}">Parametres</a></li>
                    @endif
                </ul>
            </nav>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Deconnexion</button>
            </form>
        </div>
    </header>


    <main>
        @if (session('success'))
            <div style="background: green; color: white; padding: 10px; margin: 10px 0; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background: red; color: white; padding: 10px; margin: 10px 0; border-radius: 5px;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>


    <footer class="footer">
        <p>&copy; Erika - ESIEA 2026 - Application de gestion de ticketing</p>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
