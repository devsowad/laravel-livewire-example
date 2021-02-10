<?php

namespace App\Http\Livewire;

use App\Models\SupportedTicket;
use Livewire\Component;

class Tickets extends Component
{
    public $active;

    public function __construct()
    {
        SupportedTicket::count() > 0 ? $this->active = SupportedTicket::latest()->first()->id : '';
    }

    protected $listeners = ['ticketSelected'];

    public function ticketSelected($ticketId)
    {
        $this->active = $ticketId;
    }

    public function render()
    {
        return view('livewire.tickets', [
            'tickets' => SupportedTicket::latest()->get(),
        ]);
    }
}
