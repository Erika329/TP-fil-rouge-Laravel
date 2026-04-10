@extends('layouts.app', ['title' => 'Mon profil', 'role' => auth()->user()?->role ? 'role-' . strtolower(auth()->user()->role) : 'role-collaborateur'])

@section('content')
<section>
    <h2>Mon profil</h2>

    <h3>Informations personnelles</h3>
    <table>
        <tr>
            <td><strong>Nom :</strong></td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td><strong>Email :</strong></td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td><strong>Role :</strong></td>
            <td>{{ ucfirst($user->role) }}</td>
        </tr>
        <tr>
            <td><strong>Departement :</strong></td>
            <td>{{ $user->department ?? 'Non renseigne' }}</td>
        </tr>
        <tr>
            <td><strong>Telephone :</strong></td>
            <td>{{ $user->phone ?? 'Non renseigne' }}</td>
        </tr>
    </table>
</section>

<section>
    <h2>Statistiques</h2>
    <ul>
        <li><strong>Tickets crees :</strong> {{ $user->createdTickets->count() }}</li>
        <li><strong>Tickets termines :</strong> {{ $user->createdTickets->where('status', 'termine')->count() }}</li>
        <li><strong>Heures travaillees :</strong> {{ number_format((float) $user->timeEntries->sum('duration_hours'), 2, ',', ' ') }}h</li>
        <li><strong>Heures facturables :</strong> {{ number_format((float) $user->timeEntries->filter(fn ($entry) => $entry->ticket && $entry->ticket->is_billable)->sum('duration_hours'), 2, ',', ' ') }}h</li>
    </ul>
</section>

<section>
    <h2>Actions</h2>
    <ul>
        <li><a href="{{ route('profile.edit') }}">Modifier mon profil</a></li>
        <li><a href="{{ route('password.change') }}">Changer mon mot de passe</a></li>
    </ul>
</section>
@endsection
