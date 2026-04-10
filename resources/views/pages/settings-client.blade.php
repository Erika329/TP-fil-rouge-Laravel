@extends('layouts.app', ['title' => 'Parametres - Client', 'role' => 'role-client'])

@section('content')
<section>
    <h2>Parametres client</h2>
    <form novalidate>
        <label for="client-langue">Langue</label>
        <select id="client-langue" name="client-langue">
            <option value="fr">Francais</option>
            <option value="en">English</option>
        </select>

        <label for="client-notif">Notifications email</label>
        <select id="client-notif" name="client-notif">
            <option value="1">Activees</option>
            <option value="0">Desactivees</option>
        </select>

        <button type="submit">Enregistrer</button>
    </form>
</section>
@endsection
