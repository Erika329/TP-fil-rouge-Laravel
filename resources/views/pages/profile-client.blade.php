@extends('layouts.app', ['title' => 'Profil - Client', 'role' => 'role-client'])

@section('content')
<section>
    <h2>Profil client</h2>
    <table>
        <tbody>
            <tr>
                <td><strong>Societe :</strong></td>
                <td>Agence Nova</td>
            </tr>
            <tr>
                <td><strong>Contact :</strong></td>
                <td>contact@nova.fr</td>
            </tr>
            <tr>
                <td><strong>Projets actifs :</strong></td>
                <td>2</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
