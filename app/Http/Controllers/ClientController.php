<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $query = Client::with('projects.tickets')->orderBy('name');
        
        if (auth()->check() && auth()->user()->role === 'client') {
            $query->where('id', auth()->user()->client_id);
        }

        $clients = $query->get();

        return view('clients.index', [
            'title' => 'Clients',
            'clients' => $clients,
        ]);
    }

}
