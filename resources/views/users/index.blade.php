@extends('layouts.app', ['title' => 'Utilisateurs', 'role' => 'role-admin'])

@section('content')
<section aria-labelledby="liste-utilisateurs">
    <h2 id="liste-utilisateurs">Liste des utilisateurs</h2>
    
    <a href="{{ route('users.create') }}" class="btn-creer">+ Créer utilisateur</a>
    
    <table>
        <caption>Comptes utilisateurs</caption>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Département</th>
                <th scope="col">Créé le</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>#U{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge {{ $user->role === 'admin' ? 'badge-admin' : ($user->role === 'collaborateur' ? 'badge-collab' : 'badge-client') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->phone ?? 'N/A' }}</td>
                    <td>{{ $user->department ?? 'N/A' }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">Modifier</a>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;" onsubmit="return confirm('Supprimer {{ $user->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Aucun utilisateur trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection

