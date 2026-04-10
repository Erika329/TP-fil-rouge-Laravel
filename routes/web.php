<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password.show');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot-password.submit');

// Dashboard Route
// Route racine → login si non connecté
Route::get('/', function () {
    return view('auth.login', ['title' => 'Connexion']);
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
});

// Tableaux de bord supplémentaires (non fonctionnels) pour respecter SRC
Route::view('/dashboard/admin', 'dashboards.dashboard-admin')->name('dashboard.admin');
Route::view('/dashboard/client', 'dashboards.dashboard-client')->name('dashboard.client');

// Pages legacy converties depuis src/pages (vues statiques pour parité visuelle)
Route::prefix('legacy')->name('legacy.')->group(function () {
    Route::view('/clients', 'pages.clients')->name('clients');
    Route::view('/clients-admin', 'pages.clients-admin')->name('clients-admin');
    Route::view('/projects', 'pages.projects')->name('projects');
    Route::view('/projects-admin', 'pages.projects-admin')->name('projects-admin');
    Route::view('/projects-client', 'pages.projects-client')->name('projects-client');
    Route::view('/project/{id}', 'pages.project-detail')->name('project.detail');
    Route::view('/project-create', 'pages.project-create')->name('project.create');
    Route::view('/tickets', 'pages.tickets')->name('tickets');
    Route::view('/tickets-admin', 'pages.tickets-admin')->name('tickets-admin');
    Route::view('/tickets-client', 'pages.tickets-client')->name('tickets-client');
    Route::view('/ticket/{id}', 'pages.ticket-detail')->name('ticket.detail');
    Route::view('/ticket-create', 'pages.ticket-create')->name('ticket.create');
    Route::view('/profile', 'pages.profile')->name('profile');
    Route::view('/profile-admin', 'pages.profile-admin')->name('profile-admin');
    Route::view('/profile-client', 'pages.profile-client')->name('profile-client');
    Route::view('/settings', 'pages.settings')->name('settings');
    Route::view('/settings-admin', 'pages.settings-admin')->name('settings-admin');
    Route::view('/settings-client', 'pages.settings-client')->name('settings-client');
    Route::view('/users', 'pages.users')->name('users');
    Route::view('/contracts', 'pages.contracts')->name('contracts');
    Route::view('/home', 'pages.index')->name('home');
});

// Project Routes
Route::prefix('projects')->group(function () {
    Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
});

// Ticket Routes
Route::prefix('tickets')->group(function () {
    Route::get('/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/', [TicketController::class, 'store'])->name('tickets.store');
    Route::post('/{id}/time-entries', [TicketController::class, 'storeTimeEntry'])->name('tickets.time-entries.store');
    Route::get('/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/{id}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    Route::get('/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/{ticket}/validate', [TicketController::class, 'validateTicket'])->name('tickets.validate');
    Route::delete('/{ticket}/refuse', [TicketController::class, 'refuseTicket'])->name('tickets.refuse');

    Route::get('/', [TicketController::class, 'index'])->name('tickets.index');
});

// Client Routes
Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
});

// Admin User management (création, modification, rôles)
Route::middleware('role:admin')->prefix('users')->name('users.')->group(function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');
});

// Profile Routes
Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/password/change', [ProfileController::class, 'showChangePassword'])->name('password.change');
    Route::post('/password/change', [ProfileController::class, 'changePassword'])->name('password.update');
});

// Settings Routes
Route::prefix('settings')->group(function () {
    Route::get('/', [SettingsController::class, 'show'])->name('settings.show');
    Route::put('/', [SettingsController::class, 'update'])->name('settings.update');
});
