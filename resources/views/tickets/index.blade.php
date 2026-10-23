
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Inbox</title>
</head>
<body>
    <main>
        <h1>Ticket Inbox</h1>

        @forelse ($tickets as $ticket)
            <article>
                <h2>{{ $ticket->subject }}</h2>
                <p>{{ $ticket->description }}</p>
                <p>Status: {{ $ticket->status }}</p>
            </article>
        @empty
            <p>No tickets yet.</p>
        @endforelse
    </main>
</body>
</html>