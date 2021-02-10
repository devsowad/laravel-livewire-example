<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\SupportedTicket;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $comment;
    public $image;
    public $ticketId;

    protected $rules = ['comment' => 'required|max:25'];

    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected'
    ];

    public function __construct()
    {
        SupportedTicket::count() > 0 ? $this->ticketId = SupportedTicket::latest()->first()->id : '';
    }

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function addComment()
    {
        $this->validate();
        $image = $this->storeImage();

        Comment::create([
            'body' => $this->comment,
            'image' => $image,
            'user_id' => 1,
            'supported_ticket_id' => $this->ticketId,
        ]);

        $this->comment = '';
        $this->image = '';
        session()->flash('successMsg', 'Comment added!');
    }

    public function storeImage()
    {
        if (!$this->image) return null;

        $img = ImageManagerStatic::make($this->image)->encode('jpg')->resize(300, 200);
        $name = time() . '.jpg';

        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function remove(Comment $comment)
    {
        Storage::delete('public/' . $comment->image);
        Comment::destroy($comment->id);
        session()->flash('successMsg', 'Comment deleted!');
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::where('supported_ticket_id', $this->ticketId)->latest()->paginate(2)
        ]);
    }
}
