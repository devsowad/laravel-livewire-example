<div>
    @foreach ($tickets as $ticket)
        <button class="{{ $active == $ticket->id ? 'btn-secondary' : 'btn-light' }} btn btn-block btn-lg"
            wire:click="$emit('ticketSelected', {{ $ticket->id }})">
            {{ $ticket->question }}
        </button>
    @endforeach
</div>
