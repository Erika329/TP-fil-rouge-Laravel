@extends('layouts.app', ['title' => 'Tableau de bord - Client', 'role' => 'role-client'])

@section('content')
<section aria-labelledby="resume-client">
    <h2 id="resume-client">Resume client</h2>
    <ul class="resume">
        <li>Tickets ouverts : 4</li>
        <li>En cours : 2</li>
        <li>A valider : 1</li>
        <li>Heures restantes : 18h</li>
    </ul>
</section>

<section aria-labelledby="tickets-recents-client">
    <h2 id="tickets-recents-client">Tickets recents</h2>
    <table>
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
            <tr>
                <td>Bug formulaire contact</td>
                <td>Portail client</td>
                <td>En cours</td>
                <td>Inclus</td>
                <td>05/02/2026</td>
            </tr>
            <tr>
                <td>Ajout export PDF</td>
                <td>Intranet RH</td>
                <td>A valider</td>
                <td>Facturable</td>
                <td>04/02/2026</td>
            </tr>
        </tbody>
    </table>
</section>

<section aria-labelledby="projets-client">
    <h2 id="projets-client">Mes projets</h2>
    <ul>
        <li>Portail client - Agence Nova</li>
        <li>Intranet RH - Clinique Orion</li>
    </ul>
    <p><a href="{{ route('legacy.projects.client') }}">Voir tous les projets</a></p>
</section>
@endsection
