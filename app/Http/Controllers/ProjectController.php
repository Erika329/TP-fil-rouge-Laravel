<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contract;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::with(['client', 'contract'])
            ->forCurrentUser()
            ->orderBy('name')
            ->get();

        return view('projects.index', [
            'title' => 'Projets',
            'projects' => $projects,
        ]);
    }


    public function create(): View
    {
        return view('projects.create', [
            'title' => 'Creer un projet',
            'clients' => Client::orderBy('name')->get(),
            'contracts' => Contract::orderBy('name')->get(),
            'users' => User::where('role', '!=', 'client')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom-projet' => ['required', 'string', 'max:255'],
            'client' => ['required', 'exists:clients,id'],
            'contrat' => ['nullable', 'exists:contracts,id'],
            'heures' => ['nullable', 'numeric', 'min:0'],
            'taux' => ['nullable', 'numeric', 'min:0'],
            'periode' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'string', 'max:255'],
            'collaborateurs' => ['nullable', 'array'],
            'collaborateurs.*' => ['exists:users,id'],
            'description-projet' => ['nullable', 'string'],
        ]);

        $project = Project::create([
            'name' => $validated['nom-projet'],
            'client_id' => (int) $validated['client'],
            'contract_id' => !empty($validated['contrat']) ? (int) $validated['contrat'] : null,
            'description' => $validated['description-projet'] ?? null,
            'status' => $validated['statut'],
        ]);

        $project->collaborators()->sync($validated['collaborateurs'] ?? []);

        return redirect()->route('projects.show', ['id' => $project->id]);
    }

    public function show($id): View
    {
        $project = Project::with([
            'client',
            'contract',
            'collaborators',
            'tickets.timeEntries',
        ])->findOrFail($id);

        return view('projects.show', [
            'title' => 'Detail du projet',
            'project' => $project,
        ]);
    }

    public function edit($id): View
    {
        $project = Project::with('collaborators')->findOrFail($id);

        return view('projects.create', [
            'title' => 'Modifier le projet',
            'project' => $project,
            'clients' => Client::orderBy('name')->get(),
            'contracts' => Contract::orderBy('name')->get(),
            'users' => User::where('role', '!=', 'client')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'nom-projet' => ['required', 'string', 'max:255'],
            'client' => ['required', 'exists:clients,id'],
            'contrat' => ['nullable', 'exists:contracts,id'],
            'statut' => ['required', 'string', 'max:255'],
            'collaborateurs' => ['nullable', 'array'],
            'collaborateurs.*' => ['exists:users,id'],
            'description-projet' => ['nullable', 'string'],
        ]);

        $project = Project::findOrFail($id);
        $project->update([
            'name' => $validated['nom-projet'],
            'client_id' => (int) $validated['client'],
            'contract_id' => !empty($validated['contrat']) ? (int) $validated['contrat'] : null,
            'description' => $validated['description-projet'] ?? null,
            'status' => $validated['statut'],
        ]);

        $project->collaborators()->sync($validated['collaborateurs'] ?? []);

        return redirect()->route('projects.show', ['id' => $project->id]);
    }

    public function destroy($id): RedirectResponse
    {
        Project::findOrFail($id)->delete();

        return redirect()->route('projects.index');
    }

    public function indexApi(Request $request): JsonResponse
    {
        $projects = Project::with(['client', 'contract', 'collaborators'])->get();
        return response()->json($projects);
    }

    public function showApi(Project $project): JsonResponse
    {
        $project->load(['client', 'contract', 'collaborators', 'tickets']);
        return response()->json($project);
    }
}

