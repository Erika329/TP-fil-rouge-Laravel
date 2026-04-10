@extends('layouts.app', ['title' => 'Projets - Client', 'role' => 'role-client'])

@section('content')
<section aria-labelledby="liste-projets-client">
    <h2 id="liste-projets-client">Mes projets</h2>
    <table>
        <caption>Projets actifs</caption>
        <thead>
            <tr>
                <th scope="col">Projet</th>
                <th scope="col">Contrat</th>
                <th scope="col">Heures restantes</th>
                <th scope="col">Statut</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Portail client</td>
                <td>50h / an</td>
                <td>18h</td>
                <td>Actif</td>
                <td><a href="{{ route('legacy.project.detail', ['id' => 1]) }}">Voir</a></td>
            </tr>
            <tr>
                <td>Intranet RH</td>
                <td>30h / an</td>
                <td>5h</td>
                <td>Actif</td>
                <td><a href="{{ route('legacy.project.detail', ['id' => 2]) }}">Voir</a></td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
