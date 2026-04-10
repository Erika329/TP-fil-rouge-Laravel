@extends('layouts.app')
@php
    $title = 'Tableau de bord';
    $role = 'role-collaborateur';
@endphp

@section('content')
    <section aria-labelledby="resume">
        <h2 id="resume">Résumé</h2>
        <ul class="resume">
            <li>Tickets ouverts : 6</li>
            <li>En cours : 3</li>
            <li>À valider : 2</li>
            <li>Heures restantes : 18h</li>
        </ul>
    </section>

    <section aria-labelledby="tickets-recents">
        <h2 id="tickets-recents">Tickets récents</h2>
        <table>
            <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Projet</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Priorité</th>
                    <th scope="col">Dernière mise à jour</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Bug formulaire contact</td>
                    <td>Portail client</td>
                    <td>En cours</td>
                    <td>Haute</td>
                    <td>05/02/2026</td>
                </tr>
                <tr>
                    <td>Ajout export PDF</td>
                    <td>Intranet RH</td>
                    <td>À valider</td>
                    <td>Moyenne</td>
                    <td>04/02/2026</td>
                </tr>
                <tr>
                    <td>Correction affichage mobile</td>
                    <td>Portail client</td>
                    <td>Nouveau</td>
                    <td>Basse</td>
                    <td>03/02/2026</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section aria-labelledby="projets">
        <h2 id="projets">Projets</h2>
        <ul>
            <li>Portail client — Agence Nova</li>
            <li>Intranet RH — Clinique Orion</li>
            <li>Refonte site vitrine — Studio Atlas</li>
        </ul>
        <p><a href="{{ route('projects.index') }}">Voir tous les projets</a></p>
    </section>
@endsection
