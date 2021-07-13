<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FileUploadController;
use App\Models\Comment;
use App\Models\SupportedTicket;
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
        $image = FileUploadController::upload($this->image, 'comments');

        Comment::create([
            'body'                => $this->comment,
            'image_url'           => $image->getUrl(),
            'image_public_id'     => $image->getPublicId(),
            'user_id'             => auth()->id(),
            'supported_ticket_id' => $this->ticketId,
        ]);

        $this->reset(['comment', 'image']);
        session()->flash('successMsg', 'Comment added!');
    }

    public function remove(Comment $comment)
    {
        FileUploadController::delete($comment->image_public_id);
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
