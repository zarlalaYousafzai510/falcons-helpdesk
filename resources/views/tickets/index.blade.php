<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Inbox</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 2rem auto; max-width: 1100px; padding: 0 1rem; color: #172033; }
        table { border-collapse: collapse; width: 100%; margin-top: 1rem; }
        th, td { border-bottom: 1px solid #d8deea; padding: .8rem; text-align: left; vertical-align: top; }
        th { background: #f3f5f9; }
        textarea { display: block; min-width: 220px; width: 100%; min-height: 70px; margin: .5rem 0; }
        .status { border-radius: 1rem; padding: .2rem .65rem; background: #e8edf5; }
        .success { background: #e6f6eb; padding: .75rem; }
    </style>
</head>
<body>
    <main>
        <h1>Ticket Inbox</h1>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form method="GET" action="{{ route('inbox') }}">
            <label for="status">Filter by status:</label>
            <select id="status" name="status">
                <option value="" @selected(!$status)>All tickets</option>
                <option value="open" @selected($status === 'open')>Open</option>
                <option value="closed" @selected($status === 'closed')>Closed</option>
            </select>
            <button type="submit">Filter</button>
        </form>

        <table>
            <thead>
                <tr><th>Subject</th><th>Status</th><th>Created</th><th>Description and reply</th></tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->subject }}</td>
                        <td><span class="status">{{ in_array($ticket->status, ['closed', 'resolved'], true) ? 'Closed' : 'Open' }}</span></td>
                        <td>{{ $ticket->created_at?->format('Y-m-d H:i') }}</td>
                        <td>
                            <p>{{ $ticket->description }}</p>
                            @if ($ticket->reply)
                                <p><strong>Reply:</strong> {{ $ticket->reply }}</p>
                            @endif
                            @if (!in_array($ticket->status, ['closed', 'resolved'], true))
                                <form method="POST" action="{{ route('tickets.reply', $ticket) }}">
                                    @csrf
                                    <label for="reply-{{ $ticket->id }}">Reply</label>
                                    <textarea id="reply-{{ $ticket->id }}" name="reply" required>{{ old('reply') }}</textarea>
                                    @error('reply') <p role="alert">{{ $message }}</p> @enderror
                                    <button type="submit">Send reply and close</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">No tickets found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html>
