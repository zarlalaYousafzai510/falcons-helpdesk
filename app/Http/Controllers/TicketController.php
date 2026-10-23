<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('tickets.index', [
            'tickets' => Ticket::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $ticket = Ticket::create([
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'status' => 'open',
        ]);

        return response()->json([
            'message' => 'Ticket submitted successfully.',
            'ticket' => $ticket,
        ], 201);
    }
}