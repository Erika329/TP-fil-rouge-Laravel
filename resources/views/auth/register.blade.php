@extends('layouts.auth', ['title' => 'Inscription'])

@section('content')
<div class="login-box">
    <h2>Creer un compte</h2>

    <form action="{{ route('register.submit') }}" method="POST" id="createform" novalidate>
        @csrf

        <label for="prenom">Prenom</label>
        <input id="prenom" name="prenom" type="text" placeholder="Prenom" value="{{ old('prenom') }}" required>
        <div id="prenom_error" class="error-text hidden">Le prenom est obligatoire.</div>

        <label for="nom">Nom</label>
        <input id="nom" name="nom" type="text" placeholder="Nom" value="{{ old('nom') }}" required>
        <div id="nom_error" class="error-text hidden">Le nom est obligatoire.</div>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" placeholder="votre@email.fr" value="{{ old('email') }}" required>
        @error('email')
            <div class="error-text">{{ $message }}</div>
        @enderror
        <div id="email_error" class="error-text hidden">L'email est obligatoire.</div>

        <label for="mot_de_passe">Mot de passe</label>
        <input id="mot_de_passe" name="password" type="password" placeholder="Mot de passe" required>
        <div id="mdp_error" class="error-text hidden">Le mot de passe est obligatoire.</div>

        <label for="role">Role</label>
        <select id="role" name="role" required>
            <option value="">Selectionner un role</option>
            <option value="collaborateur">Collaborateur</option>
            <option value="client">Client</option>
            <option value="admin">Admin</option>
        </select>
        <div id="role_error" class="error-text hidden">Le role est obligatoire.</div>

        <label for="password_confirmation">Confirmer le mot de passe</label>
        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmation" required>
        <div id="password_confirmation_error" class="error-text hidden">La confirmation doit correspondre au mot de passe.</div>

        <button type="submit">S'inscrire</button>
        <div id="creation_valide" class="valid-text hidden">Compte cree avec succes.</div>
    </form>

    <p style="text-align: center; margin-top: 20px; color: #333;">
        Deja inscrit ? <a href="{{ route('login.show') }}" style="color: #080a5a;">Se connecter</a>
    </p>
</div>
@endsection
