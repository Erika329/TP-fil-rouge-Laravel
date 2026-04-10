@extends('layouts.app', ['title' => isset($project) ? 'Modifier le projet' : 'Creer un projet', 'role' => auth()->user()?->role ? 'role-' . strtolower(auth()->user()->role) : 'role-collaborateur'])

@section('content')
<section>
    <h2>{{ isset($project) ? 'Modifier le projet' : 'Creer un nouveau projet' }}</h2>

    <form action="{{ isset($project) ? route('projects.update', ['id' => $project->id]) : route('projects.store') }}" method="POST" id="projectform" novalidate>
        @csrf
        @if(isset($project))
            @method('PUT')
        @endif

        <label for="nom-projet">Nom du projet *</label>
        <input id="nom-projet" name="nom-projet" type="text" placeholder="Nom du projet" value="{{ old('nom-projet', $project->name ?? '') }}" required>
        <div id="nom_projet_error" class="error-text hidden">Le nom du projet est obligatoire.</div>

        <label for="client">Client *</label>
        <select id="client" name="client" required>
            <option value="">Selectionner un client</option>
            @foreach($clients ?? [] as $client)
                <option value="{{ $client->id }}" {{ (string) old('client', $project->client_id ?? '') === (string) $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
            @endforeach
        </select>
        <div id="client_error" class="error-text hidden">Le client est obligatoire.</div>

        <label for="contrat">Contrat</label>
        <select id="contrat" name="contrat">
            <option value="">Aucun contrat</option>
            @foreach($contracts ?? [] as $contract)
                <option value="{{ $contract->id }}" {{ (string) old('contrat', $project->contract_id ?? '') === (string) $contract->id ? 'selected' : '' }}>{{ $contract->name }} - {{ number_format((float) $contract->included_hours, 2, ',', ' ') }}h</option>
            @endforeach
        </select>
        <div id="contrat_error" class="error-text hidden">Le type de contrat est obligatoire.</div>

        <label for="heures">Heures incluses (visuel)</label>
        <input id="heures" name="heures" type="number" min="0" placeholder="Ex: 50" value="{{ old('heures') }}">
        <div id="heures_error" class="error-text hidden">Le nombre d'heures est obligatoire.</div>

        <label for="taux">Taux horaire supplementaire (visuel)</label>
        <input id="taux" name="taux" type="number" min="0" placeholder="Ex: 80" value="{{ old('taux') }}">

        <label for="periode">Periode de validite (visuel)</label>
        <input id="periode" name="periode" type="text" placeholder="Ex: 2026" value="{{ old('periode') }}">


        <label for="statut">Statut *</label>
        <select id="statut" name="statut" required>
            <option value="actif" {{ old('statut', $project->status ?? '') === 'actif' ? 'selected' : '' }}>Actif</option>
            <option value="termine" {{ old('statut', $project->status ?? '') === 'termine' ? 'selected' : '' }}>Termine</option>
            <option value="en-attente" {{ old('statut', $project->status ?? '') === 'en-attente' ? 'selected' : '' }}>En attente</option>
        </select>
        <div id="statut_error" class="error-text hidden">Le statut est obligatoire.</div>

        <label for="collaborateurs">Collaborateurs assignes</label>
        <select id="collaborateurs" name="collaborateurs[]" multiple size="4">
            @php
                $selectedCollaborators = collect(old('collaborateurs', isset($project) ? $project->collaborators->pluck('id')->all() : []))->map(fn ($id) => (string) $id)->all();
            @endphp
            @foreach($users ?? [] as $user)
                <option value="{{ $user->id }}" {{ in_array((string) $user->id, $selectedCollaborators, true) ? 'selected' : '' }}>{{ $user->name }} ({{ $user->role }})</option>
            @endforeach
        </select>

        <label for="description-projet">Description</label>
        <textarea id="description-projet" name="description-projet" rows="6" placeholder="Contexte du projet">{{ old('description-projet', $project->description ?? '') }}</textarea>

        <button type="submit">{{ isset($project) ? 'Mettre a jour' : 'Creer le projet' }}</button>
    </form>

    <p><a href="{{ route('projects.index') }}"><- Retour</a></p>
</section>
@endsection
