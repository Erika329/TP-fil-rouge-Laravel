@extends('layouts.app', ['title' => 'Paramètres', 'role' => auth()->user()?->role ? 'role-' . strtolower(auth()->user()->role) : 'role-collaborateur'])

@section('content')
<section>
    <h2>Paramètres</h2>

    <h3>Préférences d'affichage</h3>
    <form>
        <label for="theme">Thème</label>
        <select id="theme" name="theme">
            <option value="auto">Automatique</option>
            <option value="clair">Clair</option>
            <option value="sombre">Sombre</option>
        </select>

        <label for="langue">Langue</label>
        <select id="langue" name="langue">
            <option value="fr" selected>Français</option>
            <option value="en">English</option>
        </select>

        <label for="elements-par-page">Éléments par page</label>
        <input id="elements-par-page" name="elements-par-page" type="number" value="20" min="5" max="100">

        <button type="submit">Enregistrer les préférences</button>
    </form>
</section>

<section>
    <h2>Notifications</h2>
    <form>
        <label>
            <input type="checkbox" name="notif-email" checked>
            Recevoir les notifications par email
        </label>

        <label>
            <input type="checkbox" name="notif-ticket-assign">
            Notifier quand un ticket m'est assigné
        </label>

        <label>
            <input type="checkbox" name="notif-ticket-update" checked>
            Notifier lors de mises à jour de tickets
        </label>

        <button type="submit">Enregistrer les notifications</button>
    </form>
</section>

<section>
    <h2>Sécurité</h2>
    <ul>
        <li><a href="{{ route('password.change') }}">Changer mon mot de passe</a></li>
        <li><a href="#">Activer l'authentification à deux facteurs</a></li>
        <li><a href="#">Mes sessions actives</a></li>
    </ul>
</section>

<section>
    <h2>Danger</h2>
    <p><a href="javascript:if(confirm('Êtes-vous sûr?')) { window.location.href='#'; }" style="color: #e74c3c;">Supprimer mon compte</a></p>
</section>
@endsection
