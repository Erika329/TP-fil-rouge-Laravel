@extends('layouts.app', ['title' => 'Tableau de bord - Admin', 'role' => 'role-admin'])

@section('content')
<section aria-labelledby="resume-admin">
    <h2 id="resume-admin">Resume admin</h2>
    <ul class="resume">
        <li>Clients : 4</li>
        <li>Projets : 6</li>
        <li>Tickets ouverts : 8</li>
        <li>Contrats actifs : 5</li>
    </ul>
</section>

<section aria-labelledby="activite-admin">
    <h2 id="activite-admin">Activite recente</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">Action</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Creation de projet</td>
                <td>Admin</td>
                <td>06/02/2026</td>
            </tr>
            <tr>
                <td>Modification contrat</td>
                <td>Admin</td>
                <td>05/02/2026</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
