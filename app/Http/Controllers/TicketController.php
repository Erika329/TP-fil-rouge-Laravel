<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function indexApi(Request $request): JsonResponse
    {
        $query = Ticket::with(['project.client', 'assignees'])
            ->withSum('timeEntries', 'duration_hours')
            ->latest('updated_at');




        if ($request->filled('recherche-ticket')) {
            $search = $request->input('recherche-ticket');
            $numericId = preg_replace('/[^0-9]/', '', $search);
            $query->where(function ($q) use ($search, $numericId) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhereRaw('id = ?', [$numericId]);
            });
        }



        if ($request->filled('filtre-statut')) {
            $query->where('status', $request->input('filtre-statut'));
        }



        if ($request->filled('filtre-type')) {
            $query->where('type', $request->input('filtre-type'));
        }
        if ($request->filled('filtre-projet')) {
            $query->whereHas('project', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('filtre-projet') . '%');
            });
        }


$tickets = $query->get();

return response()->json($tickets);

    }

    public function storeApi(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'projet' => ['required', 'exists:projects,id'],
            'description' => ['required', 'string'],
            'priorite' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:inclus,facturable'],
            'estimation' => ['nullable', 'numeric', 'min:0'],
            'assignes' => ['nullable', 'array'],
            'assignes.*' => ['exists:users,id'],
            'statut' => ['required', 'string', 'max:255'],
        ]);

        $ticket = Ticket::create([
            'title' => $validated['titre'],
            'project_id' => (int) $validated['projet'],
            'created_by' => $request->user()->id,
            'description' => $validated['description'],
            'priority' => $validated['priorite'] ?? 'moyenne',
            'type' => $validated['type'],
            'estimated_hours' => $validated['estimation'] ?? null,
            'status' => $validated['statut'],
            'is_billable' => $validated['type'] === 'facturable',
        ]);

        $ticket->assignees()->sync($validated['assignes'] ?? []);

        return response()->json($ticket->load(['project', 'assignees']), 201);
    }

    public function showApi(Ticket $ticket): JsonResponse
    {
        $ticket->load(['project.client', 'assignees', 'timeEntries.user']);
        return response()->json($ticket);
    }


    public function updateApi(Request $request, Ticket $ticket): JsonResponse
    {
        $validated = $request->validate([
            'titre' => ['sometimes', 'required', 'string', 'max:255'],
            'projet' => ['sometimes', 'required', 'exists:projects,id'],
            'description' => ['sometimes', 'required', 'string'],
            'priorite' => ['sometimes', 'nullable', 'string', 'max:255'],
            'type' => ['sometimes', 'required', 'in:inclus,facturable'],
            'estimation' => ['sometimes', 'nullable', 'numeric', 'min:0'],
            'assignes' => ['sometimes', 'nullable', 'array'],
            'assignes.*' => ['exists:users,id'],
            'statut' => ['sometimes', 'required', 'string', 'max:255'],
        ]);

        $updateData = array_filter($validated, fn($v) => $v !== null && $v !== '');

        $ticket->update($updateData + [
            'is_billable' => ($updateData['type'] ?? $ticket->type) === 'facturable',
        ]);

        if (isset($updateData['assignes'])) {
            $ticket->assignees()->sync($updateData['assignes']);
        }

        return response()->json($ticket->fresh()->load(['project', 'assignees']));
    }


    public function destroyApi(Ticket $ticket): JsonResponse
    {
        $ticket->delete();
        return response()->json(['message' => 'Ticket supprimé'], 200);
    }

    public function index(Request $request): \Illuminate\View\View
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login.show');
        }


        $query = Ticket::with(['project.client', 'timeEntries']);

        // Role filtering - admin all, collab own, client own
        if ($user->role === 'collaborateur') {

            $query->where(function ($q) use ($user) {
                $q->where('created_by', $user->id)
                  ->orWhereHas('assignees', function ($q2) use ($user) {
                      $q2->where('ticket_user.user_id', $user->id);
                  });
            });

        } elseif ($user->role === 'client') {
            $query->whereHas('project', function ($q) use ($user) {
                $q->where('client_id', $user->client_id);
            });
        }
        // admin voit tout

        $tickets = $query->latest('updated_at')->get();

        return view('tickets.index', [
            'title' => 'Tickets',
            'tickets' => $tickets,
        ]);
    }


    public function create(): View
    {
        return view('tickets.create', [
            'title' => 'Creer un ticket',
            'projects' => Project::orderBy('name')->get(),
            'users' => User::where('role', '!=', 'client')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'projet' => ['required', 'exists:projects,id'],
            'description' => ['required', 'string'],
            'priorite' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:inclus,facturable'],
            'estimation' => ['nullable', 'numeric', 'min:0'],
            'assignes' => ['nullable', 'array'],
            'assignes.*' => ['exists:users,id'],
            'statut' => ['required', 'string', 'max:255'],
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Auth required'], 401);
        }

        $ticket = Ticket::create([
            'title' => $validated['titre'],
            'project_id' => (int) $validated['projet'],
            'created_by' => $user->id,
            'description' => $validated['description'],
            'priority' => $validated['priorite'] ?? 'moyenne',
            'type' => $validated['type'],
            'estimated_hours' => $validated['estimation'] ?? null,
            'status' => $validated['statut'],
            'is_billable' => $validated['type'] === 'facturable',
        ]);

        $ticket->assignees()->sync($validated['assignes'] ?? []);

        return response()->json($ticket->load(['project.client', 'assignees']), 201);
    }


    public function show($id): View
    {
        $ticket = Ticket::with([
            'project.client',
            'project.contract',
            'assignees',
            'timeEntries.user',
        ])->findOrFail($id);

        return view('tickets.show', [
            'title' => 'Detail du ticket',
            'ticket' => $ticket,
        ]);
    }

    public function edit($id): View
    {
        $ticket = Ticket::with('assignees')->findOrFail($id);

        return view('tickets.create', [
            'title' => 'Modifier le ticket',
            'ticket' => $ticket,
            'projects' => Project::orderBy('name')->get(),
            'users' => User::where('role', '!=', 'client')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'projet' => ['required', 'exists:projects,id'],
            'description' => ['required', 'string'],
            'priorite' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:inclus,facturable'],
            'estimation' => ['nullable', 'numeric', 'min:0'],
            'assignes' => ['nullable', 'array'],
            'assignes.*' => ['exists:users,id'],
            'statut' => ['required', 'string', 'max:255'],
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'title' => $validated['titre'],
            'project_id' => (int) $validated['projet'],
            'description' => $validated['description'],
            'priority' => $validated['priorite'] ?? 'moyenne',
            'type' => $validated['type'],
            'estimated_hours' => $validated['estimation'] ?? null,
            'status' => $validated['statut'],
            'is_billable' => $validated['type'] === 'facturable',
        ]);

        $ticket->assignees()->sync($validated['assignes'] ?? []);

        return response()->json($ticket->load(['project.client', 'assignees', 'timeEntries']), 200);
    }


    public function destroy($id): RedirectResponse
    {
        Ticket::findOrFail($id)->delete();

        return redirect()->route('tickets.index');
    }

    public function storeTimeEntry(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'work_date' => ['required', 'date'],
            'duration_hours' => ['required', 'numeric', 'min:0.25'],
            'comment' => ['nullable', 'string'],
        ]);

        $ticket = Ticket::findOrFail($id);

        TimeEntry::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id() ?? User::orderBy('id')->value('id'),
            'work_date' => $validated['work_date'],
            'duration_hours' => $validated['duration_hours'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return redirect()->route('tickets.show', ['id' => $ticket->id]);
    }



    public function validateTicket(Ticket $ticket): RedirectResponse
    {
        $user = auth()->user();
        if (!$user || $user->role !== 'client' || $ticket->type !== 'facturable' || $ticket->status !== 'a_valider') {
            abort(403);
        }

        $ticket->update([
            'status' => 'valide',
        ]);

        return redirect()->back()->with('success', 'Le ticket a été validé!');
    }



    public function refuseTicket(Ticket $ticket): RedirectResponse
    {
        if (auth()->user()->role !== 'client' || $ticket->type !== 'facturable' || $ticket->status !== 'a_valider') {
            abort(403);
        }

        if (auth()->user()->client_id === $ticket->project->client_id) {
            $ticket->update([
                'status' => 'refuse',
            ]);
        }

        return redirect()->back()->with('success', 'Ticket refusé!');
    }
}


