@extends('layouts.app', ['title' => 'Projets - Admin', 'role' => 'role-admin'])

@section('content')
<section aria-labelledby="liste-projets-admin">
    <h2 id="liste-projets-admin">Gestion des projets</h2>
    <p><a class="btn-create-projet" href="{{ route('legacy.project.create') }}">Creer un projet</a></p>
    <table>
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
        <tbody>
            <tr>
                <td>Portail client</td>
                <td>Agence Nova</td>
                <td>50h / an</td>
                <td>18h</td>
                <td>Actif</td>
                <td>
                    <a href="{{ route('legacy.project.create') }}">Modifier</a>
                    <button class="btn-supprimer-projets" type="button">Supprimer</button>
                </td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
