@extends('layouts.app', ['title' => 'Modifier ' . $user->name, 'role' => 'role-admin'])

@section('content')
<section>
    <h2>Modifier {{ $user->name }}</h2>
    
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="name">Nom complet</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required>
        
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>
        
        <label for="role">Rôle</label>
        <select id="role" name="role" required>
            <option value="">Sélectionner</option>
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="collaborateur" {{ old('role', $user->role) == 'collaborateur' ? 'selected' : '' }}>Collaborateur</option>
            <option value="client" {{ old('role', $user->role) == 'client' ? 'selected' : '' }}>Client</option>
        </select>
        
        <label for="phone">Téléphone</label>
        <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}">
        
        <label for="department">Département</label>
        <input id="department" name="department" type="text" value="{{ old('department', $user->department) }}">
        
        <button type="submit">Mettre à jour</button>
    </form>
    
    <a href="{{ route('users.index') }}">← Retour</a>
</section>
@endsection

