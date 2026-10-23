<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/tickets', [TicketController::class, 'store']);
Route::get('/inbox', [TicketController::class, 'index']);