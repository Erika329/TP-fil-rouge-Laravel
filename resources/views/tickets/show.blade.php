@extends('layouts.app', ['title' => 'Detail du ticket', 'role' => auth()->user() ? 'role-' . auth()->user()->role : 'role-collaborateur'])

@section('content')
<section>
    <h2>#TK-{{ str_pad((string) $ticket->id, 3, '0', STR_PAD_LEFT) }} - {{ $ticket->title }}</h2>

    <h3>Informations</h3>
    <ul>
        <li><strong>Projet :</strong> {{ $ticket->project?->name }}</li>
        <li><strong>Client :</strong> {{ $ticket->project?->client?->name }}</li>
        <li><strong>Statut :</strong> {{ str_replace('_', ' ', ucfirst($ticket->status)) }}</li>
        <li><strong>Priorite :</strong> {{ ucfirst($ticket->priority) }}</li>
        <li><strong>Type :</strong> {{ ucfirst($ticket->type) }}</li>
        <li><strong>Temps estime :</strong> {{ $ticket->estimated_hours ? number_format((float) $ticket->estimated_hours, 2, ',', ' ') . 'h' : 'Non renseigne' }}</li>
        <li><strong>Temps reel :</strong> {{ number_format($ticket->real_hours, 2, ',', ' ') }}h</li>
        <li><strong>Temps facturable :</strong> {{ number_format($ticket->billable_hours, 2, ',', ' ') }}h</li>
        <li><strong>Cree le :</strong> {{ $ticket->created_at?->format('d/m/Y') }}</li>
        <li><strong>Mis a jour le :</strong> {{ $ticket->updated_at?->format('d/m/Y') }}</li>
    </ul>
</section>

<section>
    <h2>Description</h2>
    <p>{{ $ticket->description }}</p>
</section>

<section>
    <h2>Collaborateurs assignes</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ticket->assignees as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Aucun collaborateur assigne.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>

<section>
    <h2>Suivi du temps</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Duree (h)</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Commentaire</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ticket->timeEntries as $entry)
                <tr>
                    <td>{{ $entry->work_date?->format('d/m/Y') }}</td>
                    <td>{{ number_format((float) $entry->duration_hours, 2, ',', ' ') }}</td>
                    <td>{{ $entry->user?->name }}</td>
                    <td>{{ $entry->comment }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun temps saisi pour ce ticket.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>

<section>
    <h2>Ajouter du temps passe</h2>
    <form method="POST" action="{{ route('tickets.time-entries.store', ['id' => $ticket->id]) }}">
        @csrf
        <label for="work_date">Date</label>
        <input id="work_date" name="work_date" type="date" value="{{ old('work_date', now()->format('Y-m-d')) }}" required>

        <label for="duration_hours">Duree (heures)</label>
        <input id="duration_hours" name="duration_hours" type="number" step="0.25" min="0.25" value="{{ old('duration_hours', '1') }}" required>

        <label for="comment">Commentaire</label>
        <textarea id="comment" name="comment" rows="4" placeholder="Expliquer le travail realise">{{ old('comment') }}</textarea>

        <button type="submit">Ajouter l'entree de temps</button>
    </form>
</section>


@if(auth()->user() && auth()->user()->role === 'client' && $ticket->type === 'facturable' && $ticket->status === 'a_valider')
<section>
    <h3>Validation facturation</h3>
    <form method="POST" action="{{ route('tickets.validate', $ticket) }}" style="display: inline;">
        @csrf
        <button type="submit" style="background: green; color: white;">✅ Valider facturation</button>
    </form>
    <form method="POST" action="{{ route('tickets.refuse', $ticket) }}" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" style="background: red; color: white;">❌ Refuser</button>
    </form>
</section>
@endif

<p>
    <a href="{{ route('tickets.index') }}"><- Retour aux tickets</a>
    @if(auth()->user() && auth()->user()->role !== 'client')
    | <a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}">Modifier</a>
    @endif
</p>

@endsection
