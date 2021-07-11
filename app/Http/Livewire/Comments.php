<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\SupportedTicket;
use Illuminate\Support\Facades\Storage;
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

    protected $rules = ['comment' => 'required|max:25', 'image' => 'nullable|image|mimes:jpeg,jpg,png'];

    protected $listeners = [
        'ticketSelected',
    ];

    public function __construct()
    {
        SupportedTicket::count() > 0 ? $this->ticketId = SupportedTicket::latest()->first()->id : '';
    }

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function addComment()
    {
        $this->validate();

        $name = time() . '.' . $this->image->extension();
        $this->image->storeAs('public', $name);

        Comment::create([
            'body'                => $this->comment,
            'image'               => $name,
            'user_id'             => auth()->id(),
            'supported_ticket_id' => $this->ticketId,
        ]);

        $this->reset(['comment', 'image']);
        session()->flash('successMsg', 'Comment added!');
    }

    public function remove(Comment $comment)
    {
        Storage::delete('public/' . $comment->image);
        Comment::destroy($comment->id);
        session()->flash('successMsg', 'Comment deleted!');
    }

    public function render()
    {
        $comments = Comment::where('supported_ticket_id', $this->ticketId)->latest()->paginate(2);

        return view('livewire.comments', [
            'comments' => $comments,
        ]);
    }
}
