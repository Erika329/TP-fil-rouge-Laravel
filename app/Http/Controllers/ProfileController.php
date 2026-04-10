<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private function currentUser(): User
    {
        return auth()->user() ?? User::orderBy('id')->firstOrFail();
    }

    public function show(): View
    {
        $user = $this->currentUser()->load(['createdTickets', 'timeEntries.ticket']);

        return view('profile', [
            'title' => 'Mon profil',
            'user' => $user,
        ]);
    }

    public function edit(): View
    {
        return view('profile-edit', [
            'title' => 'Modifier mon profil',
            'user' => $this->currentUser(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:255'],
            'departement' => ['nullable', 'string', 'max:255'],
            'biographie' => ['nullable', 'string'],
        ]);

        $user = $this->currentUser();
        $user->update([
            'name' => $validated['nom'],
            'email' => $validated['email'],
            'phone' => $validated['telephone'] ?? null,
            'department' => $validated['departement'] ?? null,
            'bio' => $validated['biographie'] ?? null,
        ]);

        return redirect()->route('profile.show');
    }

    public function showChangePassword(): View
    {
        return view('password-change', ['title' => 'Changer mon mot de passe']);
    }

    public function changePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ancien-mdp' => ['required', 'string'],
            'nouveau-mdp' => ['required', 'string', 'min:6'],
            'confirmation-mdp' => ['required', 'same:nouveau-mdp'],
        ]);

        $user = $this->currentUser();

        if (!Hash::check($validated['ancien-mdp'], $user->password)) {
            return back()->withErrors(['ancien-mdp' => 'Mot de passe actuel incorrect.']);
        }

        $user->update([
            'password' => Hash::make($validated['nouveau-mdp']),
        ]);

        return redirect()->route('profile.show');
    }
}
