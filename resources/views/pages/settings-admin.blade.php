@extends('layouts.app', ['title' => 'Parametres - Admin', 'role' => 'role-admin'])

@section('content')
<section aria-labelledby="settings-admin">
    <h2 id="settings-admin">Parametres administrateur</h2>
    <form id="settings-form" novalidate>
        <label for="site-name">Nom du site</label>
        <input id="site-name" name="site-name" type="text" placeholder="Nom du site">

        <label for="maintenance">Mode maintenance</label>
        <select id="maintenance" name="maintenance">
            <option value="0">Desactive</option>
            <option value="1">Active</option>
        </select>

        <button type="submit">Enregistrer</button>
    </form>
</section>
@endsection
