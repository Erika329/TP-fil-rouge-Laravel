@extends('layouts.app', ['title' => 'Projets', 'role' => auth()->user()?->role ? 'role-' . strtolower(auth()->user()->role) : 'role-collaborateur'])

@section('content')
<section>
    <h2 id="liste-projets">Liste des projets</h2>

    <form id="filtre-projets-form" method="GET" style="margin-bottom: 20px;">
        <label for="recherche-projet">Recherche</label>
        <input id="recherche-projet" name="recherche-projet" type="search" placeholder="Nom du projet" value="{{ request('recherche-projet') }}">

        <label for="filtre-statut">Client</label>
        <select id="filtre-statut" name="filtre-statut">
            <option value="">Tous</option>
            @foreach(($projects ?? collect())->pluck('client.name')->filter()->unique()->values() as $clientName)
                <option value="{{ strtolower($clientName) }}">{{ $clientName }}</option>
            @endforeach
        </select>

        <label for="filtre-projet">Statut</label>
        <select id="filtre-projet" name="filtre-projet">
            <option value="">Tous</option>
            <option value="actif">Actif</option>
            <option value="termine">Termine</option>
            <option value="en-attente">En attente</option>
        </select>

        <button type="submit" id="btn-filtrer">Filtrer</button>
    </form>

    <table id="projects-table">
        <caption>Projets assignes</caption>
        <thead>
            <tr>
                <th scope="col">Projet</th>
                <th scope="col">Client</th>
                <th scope="col">Contrat</th>
                <th scope="col">Heures restantes</th>
                <th scope="col">Statut</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="projets-tbody">
            @forelse($projects ?? [] as $project)
                <tr>
                    <td><a href="{{ route('projects.show', ['id' => $project->id]) }}">{{ $project->name }}</a></td>
                    <td>{{ $project->client?->name }}</td>
                    <td>{{ $project->contract?->name ?? 'Sans contrat' }}</td>
                    <td>{{ number_format($project->remaining_hours, 2, ',', ' ') }}h</td>
                    <td>{{ ucfirst($project->status) }}</td>
                    <td><a href="{{ route('projects.show', ['id' => $project->id]) }}">Voir</a> | <a href="{{ route('projects.edit', ['id' => $project->id]) }}">Modifier</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucun projet enregistre.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p><a href="{{ route('projects.create') }}">+ Creer un projet</a></p>
</section>
@endsection
