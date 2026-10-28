<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $tickets = Ticket::query()->latest();

        if ($status === 'open') {
            $tickets->whereIn('status', ['open', 'in_progress']);
        } elseif ($status === 'closed') {
            $tickets->whereIn('status', ['closed', 'resolved']);
        }

        return view('tickets.index', [
            'tickets' => $tickets->get(),
            'status' => $status,
        ]);
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'reply' => ['required', 'string'],
        ]);

        $ticket->update([
            'reply' => $validated['reply'],
            'status' => 'closed',
        ]);

        return redirect()->route('inbox', ['status' => $request->query('status')])
            ->with('success', 'Reply saved and ticket closed.');
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
