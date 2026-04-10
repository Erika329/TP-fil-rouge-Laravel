@extends('layouts.app', ['title' => 'Tickets - Client', 'role' => 'role-client'])

@section('content')
<section aria-labelledby="liste-tickets-client">
    <h2 id="liste-tickets-client">Mes tickets</h2>
    <form id="tickets-client-filter" novalidate>
        <label for="recherche-ticket">Recherche</label>
        <input id="recherche-ticket" name="recherche-ticket" type="search" placeholder="Titre ou ID">

        <label for="filtre-statut">Statut</label>
        <select id="filtre-statut" name="filtre-statut">
            <option value="">Tous</option>
            <option value="ouverts">Ouverts</option>
            <option value="en cours">En cours</option>
            <option value="a valider">A valider</option>
            <option value="valide">Valide</option>
            <option value="refuse">Refuse</option>
            <option value="termine">Termine</option>
        </select>

        <button type="button">Filtrer</button>
    </form>

    <table id="tickets-client-table">
        <caption>Tickets lies a mes projets</caption>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titre</th>
                <th scope="col">Projet</th>
                <th scope="col">Statut</th>
                <th scope="col">Type</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#TK-001</td>
                <td>Bug formulaire contact</td>
                <td>Portail client</td>
                <td>En cours</td>
                <td>Inclus</td>
                <td><a href="{{ route('legacy.ticket.detail', ['id' => 1]) }}">Voir</a></td>
            </tr>
            <tr>
                <td>#TK-002</td>
                <td>Ajout export PDF</td>
                <td>Intranet RH</td>
                <td>A valider</td>
                <td>Facturable</td>
                <td><a href="{{ route('legacy.ticket.detail', ['id' => 2]) }}">Voir</a></td>
            </tr>
        </tbody>
    </table>
</section>

<section aria-labelledby="validation-tickets">
    <h2 id="validation-tickets">Validation des tickets facturables</h2>
    <div id="notif-ticket-client" class="notif" style="display: none;"></div>
    <table>
        <caption>Tickets a valider</caption>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titre</th>
                <th scope="col">Temps passe</th>
                <th scope="col">Montant estime</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#TK-002</td>
                <td>Ajout export PDF</td>
                <td>3h</td>
                <td>240 EUR</td>
                <td><button class="btn-accepter" type="button">Accepter</button> | <button class="btn-refuser" type="button">Refuser</button></td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
