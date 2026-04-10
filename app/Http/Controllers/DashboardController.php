<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Project;
use App\Models\Ticket;
use Illuminate\View\View;

class DashboardController extends Controller
{
public function show(): View
    {
        $role = auth()->user()?->role ?? 'collaborateur';



        $recentTickets = Ticket::with('project')
            ->latest('updated_at')
            ->take(3)
            ->get();

        $projects = Project::with(['client', 'contract'])
            ->orderBy('name')
            ->take(3)
            ->get();

        $stats = [
            'open_tickets' => Ticket::whereIn('status', ['nouveau', 'en_cours', 'ouvert'])->count(),
            'in_progress_tickets' => Ticket::where('status', 'en_cours')->count(),
            'to_validate_tickets' => Ticket::where('status', 'a_valider')->count(),
            'remaining_hours' => round(Project::with('contract')->get()->sum->remaining_hours, 2),
            'clients' => \App\Models\Client::count(),
            'projects' => Project::count(),
            'active_contracts' => Contract::count(),
        ];

        return view('dashboard', [
            'title' => 'Tableau de bord',
            'role' => $role,
            'stats' => $stats,
            'recentTickets' => $recentTickets,
            'projects' => $projects,
        ]);
    }
}
