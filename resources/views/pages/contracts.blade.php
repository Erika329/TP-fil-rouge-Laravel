@extends('layouts.app', ['title' => 'Contrats', 'role' => 'role-admin'])

@section('content')
<section aria-labelledby="liste-contrats">
    <h2 id="liste-contrats">Contrats</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">Contrat</th>
                <th scope="col">Client</th>
                <th scope="col">Duree</th>
                <th scope="col">Statut</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Contrat Nova</td>
                <td>Agence Nova</td>
                <td>12 mois</td>
                <td>Actif</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
