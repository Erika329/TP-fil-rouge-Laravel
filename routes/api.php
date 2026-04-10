<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/tickets', [TicketController::class, 'indexApi']);
    Route::post('/tickets', [TicketController::class, 'storeApi']);
    Route::get('/tickets/{ticket}', [TicketController::class, 'showApi']);
    Route::put('/tickets/{ticket}', [TicketController::class, 'updateApi']);
    
    Route::get('/projects', [ProjectController::class, 'indexApi']);
    Route::get('/projects/{project}', [ProjectController::class, 'showApi']);
});


// Public endpoints if needed
Route::get('/tickets', [TicketController::class, 'indexPublic']);
