@extends('layouts.app', ['title' => 'Créer utilisateur', 'role' => 'role-admin'])

@section('content')
<section>
    <h2>Créer un nouvel utilisateur</h2>
    
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Nom complet *</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required>
        
        <label for="email">Email *</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required>
        
        <label for="password">Mot de passe *</label>
        <input id="password" name="password" type="password" required>
        
        <label for="password_confirmation">Confirmer mot de passe *</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required>
        
        <label for="role">Rôle *</label>
        <select id="role" name="role" required>
            <option value="">Sélectionner</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="collaborateur" {{ old('role') == 'collaborateur' ? 'selected' : '' }}>Collaborateur</option>
            <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
        </select>
        
        <label for="phone">Téléphone</label>
        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}">
        
        <label for="department">Département</label>
        <input id="department" name="department" type="text" value="{{ old('department') }}">
        
        <button type="submit">Créer</button>
    </form>
    
    <a href="{{ route('users.index') }}">← Retour</a>
</section>
@endsection

