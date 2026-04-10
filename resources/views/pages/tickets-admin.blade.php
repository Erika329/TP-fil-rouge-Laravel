@extends('layouts.app', ['title' => 'Tickets - Admin', 'role' => 'role-admin'])

@section('content')
<section aria-labelledby="liste-tickets-admin">
    <h2 id="liste-tickets-admin">Gestion des tickets</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titre</th>
                <th scope="col">Projet</th>
                <th scope="col">Statut</th>
                <th scope="col">Priorite</th>
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
                <td>Haute</td>
                <td>Inclus</td>
                <td>
                    <a href="{{ route('legacy.ticket.detail', ['id' => 1]) }}">Voir</a> |
                    <button type="button">Forcer statut</button>
                </td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
