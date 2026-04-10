@extends('layouts.app', ['title' => 'Utilisateurs', 'role' => 'role-admin'])

@section('content')
<section aria-labelledby="liste-utilisateurs">
    <h2 id="liste-utilisateurs">Liste des utilisateurs</h2>
    <table>
        <caption>Comptes actifs</caption>
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Role</th>
                <th scope="col">Email</th>
                <th scope="col">Statut</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Erika K.</td>
                <td>Collaborateur</td>
                <td>erika@exemple.fr</td>
                <td>Actif</td>
                <td><button class="btn-supprimer" type="button">Supprimer</button></td>
            </tr>
            <tr>
                <td>Client Nova</td>
                <td>Client</td>
                <td>contact@nova.fr</td>
                <td>Actif</td>
                <td><button class="btn-supprimer" type="button">Supprimer</button></td>
            </tr>
        </tbody>
    </table>
</section>

<section aria-labelledby="formulaire-user">
    <h2 id="formulaire-user">Creation d'un nouvel utilisateur</h2>
    <form id="user-form" class="user-form" novalidate>
        <label for="nom">Nom</label>
        <input id="nom" name="nom" type="text" placeholder="Nom de l'utilisateur">
        <div id="nom_error" class="error-text hidden">Le nom est obligatoire.</div>

        <label for="prenom">Prenom</label>
        <input id="prenom" name="prenom" type="text" placeholder="Prenom de l'utilisateur">
        <div id="prenom_error" class="error-text hidden">Le prenom est obligatoire.</div>

        <label for="mail">Email</label>
        <input id="mail" name="mail" type="email" placeholder="exemple@domaine.fr">
        <div id="email_error" class="error-text hidden">L'email est obligatoire.</div>

        <label for="role">Role</label>
        <select id="role" name="role">
            <option value="">Selectionner un role</option>
            <option value="collaborateur">Collaborateur</option>
            <option value="administrateur">Administrateur</option>
            <option value="client">Client</option>
        </select>
        <div id="role_error" class="error-text hidden">Le role est obligatoire.</div>

        <button type="button" onclick="triggerSubmit(document.getElementById('user-form'))">Enregistrer</button>
    </form>
</section>
@endsection
