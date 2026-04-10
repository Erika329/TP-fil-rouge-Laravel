@extends('layouts.auth', ['title' => 'Mot de passe oublie'])

@section('content')
<div class="login-box">
    <h1>Mot de passe oublie</h1>
    <p style="text-align: center; margin-bottom: 20px; color: #666;">Entrez votre email pour recevoir un lien de reinitialisation.</p>

    <form method="POST" action="{{ route('forgot-password.submit') }}" id="forgotform" novalidate>
        @csrf

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="error-text">{{ $message }}</div>
        @enderror
        <div id="email_error" class="error-text hidden">L'email est obligatoire.</div>

        <button type="submit">Envoyer</button>
        <div id="mail_valide" class="valid-text hidden">Lien de reinitialisation envoye.</div>
    </form>

    <p style="text-align: center; margin-top: 15px;">
        <a href="{{ route('login.show') }}" style="color: #667eea; text-decoration: none;">Retour a la connexion</a>
    </p>
</div>
@endsection
