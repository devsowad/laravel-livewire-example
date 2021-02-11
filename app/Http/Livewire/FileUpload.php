<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public $photos = [];

    protected $rules = ['photos.*' => 'image|max:1024|mimes:jpeg,jpg,png,svg'];

    public function remove($index)
    {
        array_splice($this->photos, $index, 1);
    }

    public function updatedPhoto()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        foreach ($this->photos as $photo) {
            $photo->store('public/photos');
        }
        $this->photos = [];
        session()->flash('successMsg', 'Saved successfully');
    }

    public function render()
    {
        return view('livewire.file-upload');
    }
}
