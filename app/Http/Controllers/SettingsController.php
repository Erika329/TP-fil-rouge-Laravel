<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function show(): View
    {
        return view('settings', ['title' => 'Parametres']);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'theme' => ['nullable', 'string'],
            'langue' => ['nullable', 'string'],
        ]);

        return redirect()->route('settings.show');
    }
}
