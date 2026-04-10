@extends('layouts.app', ['title' => 'Modifier mon profil', 'role' => 'role-collaborateur'])

@section('content')
<section>
    <h2>Modifier mon profil</h2>

    <form method="POST" action="{{ route('profile.update') }}" id="profile-form" novalidate>
        @csrf
        @method('PUT')

        <div style="margin-bottom: 16px;">
            <label for="nom" style="display: block; color: #333; font-weight: 500; margin-bottom: 6px;">Nom</label>
            <input type="text" id="nom" name="nom" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; color: #333; box-sizing: border-box;" value="{{ old('nom', $user->name ?? '') }}" required>
            <div id="nom_error" class="error-text hidden">Le nom est obligatoire.</div>
            @error('nom')
                <div style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label for="email" style="display: block; color: #333; font-weight: 500; margin-bottom: 6px;">Email</label>
            <input type="email" id="email" name="email" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; color: #333; box-sizing: border-box;" value="{{ old('email', $user->email ?? '') }}" required>
            <div id="email_error" class="error-text hidden">L'email est obligatoire.</div>
            @error('email')
                <div style="color: #d32f2f; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label for="telephone" style="display: block; color: #333; font-weight: 500; margin-bottom: 6px;">Telephone</label>
            <input type="tel" id="telephone" name="telephone" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; color: #333; box-sizing: border-box;" value="{{ old('telephone', $user->phone ?? '') }}">
        </div>

        <div style="margin-bottom: 16px;">
            <label for="departement" style="display: block; color: #333; font-weight: 500; margin-bottom: 6px;">Departement</label>
            <input type="text" id="departement" name="departement" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; color: #333; box-sizing: border-box;" value="{{ old('departement', $user->department ?? '') }}">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="biographie" style="display: block; color: #333; font-weight: 500; margin-bottom: 6px;">Biographie</label>
            <textarea id="biographie" name="biographie" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; color: #333; box-sizing: border-box;">{{ old('biographie', $user->bio ?? '') }}</textarea>
        </div>

        <button type="submit">Enregistrer</button>
    </form>

    <h2 style="color: #d32f2f; margin-top: 32px;">Securite</h2>
    <p><a href="{{ route('password.change') }}">Changer mon mot de passe</a></p>
</section>
@endsection
