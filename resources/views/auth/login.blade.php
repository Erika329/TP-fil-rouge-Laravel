@extends('layouts.auth', ['title' => 'Connexion'])

@section('content')
<div class="login-box">
    <img src="{{ asset('images/icon.png') }}" alt="Icône utilisateur" style="width: 60px; height: 60px;">
    <h2>Connexion</h2>
    
    <form action="{{ route('login.submit') }}" method="POST" id="submitform" novalidate>
        @csrf
        
        <label for="identifiant">Email</label>
        <input 
            id="identifiant" 
            name="email" 
            type="email" 
            placeholder="test@email.com"
            value="{{ old('email') }}"
            required
        >
        @error('email')
            <div class="error-text">{{ $message }}</div>
        @enderror
        <div id="identifiant_error" class="error-text hidden">L'email est obligatoire.</div>

        <label for="mot_de_passe">Mot de passe</label>
        <input 
            id="mot_de_passe" 
            name="password" 
            type="password" 
            placeholder="Mot de passe"
            required
        >
        @error('password')
            <div class="error-text">{{ $message }}</div>
        @enderror
        <div id="mdp_error" class="error-text hidden">Le mot de passe est obligatoire.</div>

        <button type="submit">Connexion</button>

        <div id="connexion_valide" class="valid-text hidden">Connexion réussie.</div>

        <a href="{{ route('forgot-password.show') }}" class="forgot-link">Mot de passe oublié ?</a>
    </form>

    <br>
    <a href="{{ route('register.show') }}" class="forgot-link">Créer un compte</a>
</div>
@endsection
