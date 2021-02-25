<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Things extends Component
{
    public $things = [
        ['id' => 1, 'title' => 'Do Dishes'],
        ['id' => 2, 'title' => 'Dust Shelves'],
        ['id' => 3, 'title' => 'Clean Counters'],
        ['id' => 4, 'title' => 'Fold Laundry'],
        ['id' => 5, 'title' => 'Scrub Toilet'],
    ];

    public function reorder($orderIds)
    {
        $this->things = collect($orderIds)->map(function ($id) {
            return collect($this->things)->where('id', (int) $id)->first();
        })->toArray();

        cache()->put('orderIds', $orderIds);
    }

    public function render()
    {
        if (cache()->has('orderIds')) $this->reorder(cache('orderIds'));
        return view('livewire.things');
    }
}
