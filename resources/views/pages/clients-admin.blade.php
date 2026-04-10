@extends('layouts.app', ['title' => 'Clients - Admin', 'role' => 'role-admin'])

@section('content')
<section aria-labelledby="liste-clients">
    <h2 id="liste-clients">Liste des clients</h2>
    <table id="clients-table">
        <caption>Comptes clients</caption>
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Statut</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Client Nova</td>
                <td>contact@nova.fr</td>
                <td>Actif</td>
                <td><button class="btn-supprimer" type="button">Supprimer</button></td>
            </tr>
            <tr>
                <td>Client Alpha</td>
                <td>alpha@exemple.fr</td>
                <td>Actif</td>
                <td><button class="btn-supprimer" type="button">Supprimer</button></td>
            </tr>
        </tbody>
    </table>
</section>

<section aria-labelledby="formulaire-client">
    <h2 id="formulaire-client">Creation d'un nouveau client</h2>
    <form id="client-form" novalidate>
        <label for="client-nom">Nom</label>
        <input id="client-nom" name="client-nom" type="text" placeholder="Nom du client">

        <label for="client-mail">Email</label>
        <input id="client-mail" name="client-mail" type="email" placeholder="exemple@domaine.fr">

        <button type="submit">Enregistrer</button>
    </form>
</section>
@endsection
