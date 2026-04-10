@extends('layouts.app', ['title' => 'Changer mon mot de passe', 'role' => 'role-collaborateur'])

@section('content')
<section>
    <h2>Changer mon mot de passe</h2>

    <form method="POST" action="{{ route('password.update') }}" id="password-form" novalidate>
        @csrf

        <label for="ancien-mdp">Ancien mot de passe *</label>
        <input id="ancien-mdp" name="ancien-mdp" type="password" placeholder="Ancien mot de passe" required>

        <label for="nouveau-mdp">Nouveau mot de passe *</label>
        <input id="nouveau-mdp" name="nouveau-mdp" type="password" placeholder="Nouveau mot de passe" required>

        <label for="confirmation-mdp">Confirmer le mot de passe *</label>
        <input id="confirmation-mdp" name="confirmation-mdp" type="password" placeholder="Confirmer le mot de passe" required>

        <button type="submit">Modifier</button>
    </form>

    <p><a href="{{ route('profile.show') }}">← Retour</a></p>
</section>
@endsection
