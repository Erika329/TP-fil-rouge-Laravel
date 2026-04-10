@php
$displayRole = auth()->user()?->role ?? 'collaborateur';
@endphp
@extends('layouts.app', ['title' => 'Tableau de bord', 'role' => 'role-' . $displayRole])

@section('content')

@if($displayRole === 'admin')
    <section aria-labelledby="resume">
        <h2 id="resume">Resume admin</h2>
        <ul class="resume">
            <li>Clients : {{ $stats['clients'] ?? 0 }}</li>
            <li>Projets : {{ $stats['projects'] ?? 0 }}</li>
            <li>Tickets ouverts : {{ $stats['open_tickets'] ?? 0 }}</li>
            <li>Contrats actifs : {{ $stats['active_contracts'] ?? 0 }}</li>
        </ul>
    </section>
@elseif($displayRole === 'client')
    <section aria-labelledby="resume">
        <h2 id="resume">Resume client</h2>
        <ul class="resume">
            <li>Tickets ouverts : {{ $stats['open_tickets'] ?? 0 }}</li>
            <li>En cours : {{ $stats['in_progress_tickets'] ?? 0 }}</li>
            <li>A valider : {{ $stats['to_validate_tickets'] ?? 0 }}</li>
            <li>Heures restantes : {{ $stats['remaining_hours'] ?? 0 }}h</li>
        </ul>
    </section>
@else
    <section aria-labelledby="resume">
        <h2 id="resume">Resume</h2>
        <ul class="resume">
            <li>Tickets ouverts : {{ $stats['open_tickets'] ?? 0 }}</li>
            <li>En cours : {{ $stats['in_progress_tickets'] ?? 0 }}</li>
            <li>A valider : {{ $stats['to_validate_tickets'] ?? 0 }}</li>
            <li>Heures restantes : {{ $stats['remaining_hours'] ?? 0 }}h</li>
        </ul>
    </section>
@endif

<section aria-labelledby="tickets-recents">
    <h2 id="tickets-recents">Tickets recents</h2>
    <table>
        <caption>Derniers tickets</caption>
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Projet</th>
                <th scope="col">Statut</th>
                <th scope="col">Type</th>
                <th scope="col">Derniere mise a jour</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentTickets ?? [] as $ticket)
                <tr>
                    <td><a href="{{ route('tickets.show', ['id' => $ticket->id]) }}">{{ $ticket->title }}</a></td>
                    <td>{{ $ticket->project?->name }}</td>
                    <td>{{ str_replace('_', ' ', ucfirst($ticket->status)) }}</td>
                    <td>{{ ucfirst($ticket->type) }}</td>
                    <td>{{ $ticket->updated_at?->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucun ticket pour le moment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <p><a href="{{ route('tickets.index') }}">Voir tous les tickets -></a></p>
</section>

<section aria-labelledby="projets">
    <h2 id="projets">Projets</h2>
    <ul>
        @forelse($projects ?? [] as $project)
            <li>{{ $project->name }} - {{ $project->client?->name }}</li>
        @empty
            <li>Aucun projet enregistre.</li>
        @endforelse
    </ul>
    <p><a href="{{ route('projects.index') }}">Voir tous les projets -></a></p>
</section>

@endsection
