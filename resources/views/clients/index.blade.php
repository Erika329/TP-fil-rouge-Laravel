@extends('layouts.app', ['title' => 'Clients', 'role' => 'role-collaborateur'])

@section('content')
<section>
    <h2>Clients</h2>

    <table>
        <caption>Liste des clients</caption>
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Telephone</th>
                <th scope="col">Projets</th>
                <th scope="col">Tickets</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients ?? [] as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->projects->count() }}</td>
                    <td>{{ $client->projects->sum(fn ($project) => $project->tickets->count()) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucun client enregistre.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection
