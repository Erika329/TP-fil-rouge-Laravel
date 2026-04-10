@extends('layouts.app', ['title' => 'Tickets', 'role' => auth()->user()?->role ? 'role-' . strtolower(auth()->user()->role) : 'role-collaborateur'])

@section('content')
<section>
    <h2 id="liste-tickets">Liste des tickets</h2>

    <form id="filtre-tickets-form" method="GET" style="margin-bottom: 20px;">
        <label for="recherche-ticket">Recherche</label>
        <input id="recherche-ticket" name="recherche-ticket" type="search" placeholder="Titre ou ID" value="{{ request('recherche-ticket') }}">

        <label for="filtre-statut">Statut</label>
        <select id="filtre-statut" name="filtre-statut">
            <option value="">Tous</option>

            @foreach(['nouveau', 'ouvert', 'en_cours', 'a_valider', 'termine', 'refuse'] as $status)
                <option value="{{ $status }}">{{ str_replace('_', ' ', ucfirst($status)) }}</option>
            @endforeach

        </select>




        <label for="filtre-type">Type</label>
        <select id="filtre-type" name="filtre-type">
            <option value="">Tous</option>
            <option value="inclus">Inclus</option>
            <option value="facturable">Facturable</option>
        </select>

        <button type="submit">Filtrer</button>
    </form>

    <table id="tickets-table">
        <caption>Tous les tickets</caption>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titre</th>
                <th scope="col">Projet</th>
                <th scope="col">Statut</th>
                <th scope="col">Priorite</th>
                <th scope="col">Type</th>
                <th scope="col">Temps reel</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
<tbody id="tickets-tbody">
            </tbody>
        </table>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadTickets();

    document.getElementById('filtre-tickets-form').addEventListener('submit', function(e) {
        e.preventDefault();
        loadTickets();
    });
});

async function loadTickets() {
    const formData = new FormData(document.getElementById('filtre-tickets-form'));
    const params = new URLSearchParams(formData).toString();

    try {
        const response = await fetch(`/api/v1/tickets?${params}`, {

                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
            });

            if (!response.ok) {
                console.error('API error:', response.status, response.statusText);
                throw new Error('Erreur chargement: ' + response.status);
            }

        const tickets = await response.json();

        const tbody = document.getElementById('tickets-tbody');
        if (tickets.length === 0) {
            tbody.innerHTML = '<tr><td colspan="8">Aucun ticket trouvé.</td></tr>';
            return;
        }

        tbody.innerHTML = tickets.map(ticket => `
            <tr>
                <td>#TK-${String(ticket.id).padStart(3, '0')}</td>
                <td><a href="/tickets/${ticket.id}">${ticket.title}</a></td>
                <td>${ticket.project?.name || ''}</td>
                <td>${ticket.status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}</td>
                <td>${ticket.priority.charAt(0).toUpperCase() + ticket.priority.slice(1)}</td>
                <td>${ticket.type.charAt(0).toUpperCase() + ticket.type.slice(1)}</td>
                <td>${Number(ticket.time_entries_sum_duration_hours || 0).toLocaleString('fr-FR', {minimumFractionDigits: 2, maximumFractionDigits: 2})}h</td>



                <td><a href="/tickets/${ticket.id}">Voir</a> | <a href="/tickets/${ticket.id}/edit">Modifier</a></td>
            </tr>
        `).join('');
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors du chargement des tickets');
    }
}
</script>

    <p><a href="{{ route('tickets.create') }}">+ Creer un ticket</a></p>
</section>
@endsection
