<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    public $photo;

    use WithFileUploads;

    public function render()
    {
        return view('livewire.file-upload');
    }
}
