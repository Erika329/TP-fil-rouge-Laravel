@extends('layouts.app', ['title' => isset($ticket) ? 'Modifier le ticket' : 'Creer un ticket', 'role' => auth()->user()?->role ? 'role-' . strtolower(auth()->user()->role) : 'role-collaborateur'])

@section('content')
<section>
    <h2>{{ isset($ticket) ? 'Modifier le ticket' : 'Creer un nouveau ticket' }}</h2>

    <form class="ticket-form" id="ticket-form" action="{{ isset($ticket) ? route('tickets.update', ['id' => $ticket->id]) : route('tickets.store') }}" method="POST" novalidate>
        @csrf
@if(isset($ticket))
            @method('PUT')
        @endif

        <label for="titre">Titre *</label>
        <input id="titre" name="titre" type="text" placeholder="Titre du ticket" value="{{ old('titre', $ticket->title ?? '') }}" required>
        <div id="titre_error" class="error-text hidden">Le titre est obligatoire.</div>

        <label for="projet">Projet *</label>
        <select id="projet" name="projet" required>
            <option value="">Selectionner un projet</option>
            @foreach($projects ?? [] as $project)
                <option value="{{ $project->id }}" {{ (string) old('projet', $ticket->project_id ?? '') === (string) $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
            @endforeach
        </select>
        <div id="projet_error" class="error-text hidden">Le projet est obligatoire.</div>

        <label for="description">Description *</label>
        <textarea id="description" name="description" rows="6" placeholder="Decrire la demande" required>{{ old('description', $ticket->description ?? '') }}</textarea>
        <div id="description_error" class="error-text hidden">La description est obligatoire.</div>

        <label for="priorite">Priorite</label>
        <select id="priorite" name="priorite">
            <option value="basse" {{ old('priorite', $ticket->priority ?? '') === 'basse' ? 'selected' : '' }}>Basse</option>
            <option value="moyenne" {{ old('priorite', $ticket->priority ?? '') === 'moyenne' ? 'selected' : '' }}>Moyenne</option>
            <option value="haute" {{ old('priorite', $ticket->priority ?? '') === 'haute' ? 'selected' : '' }}>Haute</option>
        </select>

        <label for="type">Type de ticket *</label>
        <select id="type" name="type" required>
            <option value="">Selectionner le type</option>
            <option value="inclus" {{ old('type', $ticket->type ?? '') === 'inclus' ? 'selected' : '' }}>Inclus</option>
            <option value="facturable" {{ old('type', $ticket->type ?? '') === 'facturable' ? 'selected' : '' }}>Facturable</option>
        </select>
        <div id="type_error" class="error-text hidden">Le type est obligatoire.</div>

        <label for="estimation">Temps estime (heures)</label>
        <input id="estimation" name="estimation" type="number" min="0" step="0.5" placeholder="Ex: 2.5" value="{{ old('estimation', $ticket->estimated_hours ?? '') }}">

        <label for="assignes">Collaborateurs assignes</label>
        <select id="assignes" name="assignes[]" multiple size="4">
            @php
                $selectedAssignees = collect(old('assignes', isset($ticket) ? $ticket->assignees->pluck('id')->all() : []))->map(fn ($id) => (string) $id)->all();
            @endphp
            @foreach($users ?? [] as $user)
                <option value="{{ $user->id }}" {{ in_array((string) $user->id, $selectedAssignees, true) ? 'selected' : '' }}>{{ $user->name }} ({{ $user->role }})</option>
            @endforeach
        </select>

        <label for="statut">Statut *</label>
        <select id="statut" name="statut" required>
            <option value="">Selectionner le statut</option>
            <option value="nouveau" {{ old('statut', $ticket->status ?? '') === 'nouveau' ? 'selected' : '' }}>Nouveau</option>
            <option value="ouvert" {{ old('statut', $ticket->status ?? '') === 'ouvert' ? 'selected' : '' }}>Ouvert</option>
            <option value="en_cours" {{ old('statut', $ticket->status ?? '') === 'en_cours' ? 'selected' : '' }}>En cours</option>
            <option value="a_valider" {{ old('statut', $ticket->status ?? '') === 'a_valider' ? 'selected' : '' }}>A valider</option>
            <option value="termine" {{ old('statut', $ticket->status ?? '') === 'termine' ? 'selected' : '' }}>Termine</option>
            <option value="refuse" {{ old('statut', $ticket->status ?? '') === 'refuse' ? 'selected' : '' }}>Refuse</option>
        </select>
        <div id="statut_error" class="error-text hidden">Le statut est obligatoire.</div>

<button type="button" id="submit-btn">{{ isset($ticket) ? 'Mettre a jour' : 'Creer le ticket' }}</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('submit-btn').addEventListener('click', async function() {
        const formData = new FormData(document.getElementById('ticket-form'));
        const data = Object.fromEntries(formData);
        data.assignes = Array.from(formData.getAll('assignes[]'));

        try {

            const isEdit = document.getElementById('ticket-form').action.includes('/update');
            const method = isEdit ? 'PUT' : 'POST';
            
            const response = await fetch(document.getElementById('ticket-form').action, {
                method: method === 'PUT' ? 'PUT' : 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-HTTP-Method-Override': method,
                },
                credentials: 'same-origin'
            });

            if (response.ok) {
                alert('✅ Ticket créé !');
                window.location.href = '/tickets';
            } else {
                const result = await response.text();
                console.error(result);
                alert('❌ Erreur serveur');
            }

        } catch (error) {
            alert('❌ Erreur connexion: ' + error.message);
        }
    });
});
</script>
        </div>
    </form>





    <p><a href="{{ route('tickets.index') }}"><- Retour aux tickets</a></p>
</section>
@endsection
