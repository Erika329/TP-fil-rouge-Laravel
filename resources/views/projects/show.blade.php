@extends('layouts.app', ['title' => 'Detail du projet', 'role' => 'role-collaborateur'])

@section('content')
<section>
    <h2>{{ $project->name }}</h2>

    <h3>Informations</h3>
    <ul>
        <li><strong>Client :</strong> {{ $project->client?->name }}</li>
        <li><strong>Statut :</strong> {{ ucfirst($project->status) }}</li>
        <li><strong>Contrat :</strong> {{ $project->contract?->name ?? 'Sans contrat' }}</li>
        <li><strong>Heures incluses consommees :</strong> {{ number_format($project->included_hours_consumed, 2, ',', ' ') }}h</li>
        <li><strong>Heures restantes :</strong> {{ number_format($project->remaining_hours, 2, ',', ' ') }}h</li>
        <li><strong>Heures facturables :</strong> {{ number_format($project->billable_hours, 2, ',', ' ') }}h</li>
        <li><strong>Montant a facturer :</strong> {{ number_format($project->billable_amount, 2, ',', ' ') }} EUR</li>
    </ul>
</section>

<section>
    <h2>Collaborateurs assignes</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse($project->collaborators as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Aucun collaborateur assigne.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>

<section>
    <h2>Tickets du projet</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titre</th>
                <th scope="col">Statut</th>
                <th scope="col">Type</th>
                <th scope="col">Temps reel</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($project->tickets as $ticket)
                <tr>
                    <td>#TK-{{ str_pad((string) $ticket->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td><a href="{{ route('tickets.show', ['id' => $ticket->id]) }}">{{ $ticket->title }}</a></td>
                    <td>{{ str_replace('_', ' ', ucfirst($ticket->status)) }}</td>
                    <td>{{ ucfirst($ticket->type) }}</td>
                    <td>{{ number_format($ticket->real_hours, 2, ',', ' ') }}h</td>
                    <td><a href="{{ route('tickets.show', ['id' => $ticket->id]) }}">Voir</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucun ticket lie a ce projet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>

<p>
    <a href="{{ route('projects.index') }}"><- Retour aux projets</a> |
    <a href="{{ route('projects.edit', ['id' => $project->id]) }}">Modifier</a>
</p>
@endsection
