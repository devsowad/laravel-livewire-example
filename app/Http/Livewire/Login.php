<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $form = [
        'email' => '',
        'password' => '',
    ];

    public function submit()
    {
        $this->validate([
            'form.email' => 'required|email',
            'form.password' => 'required',
        ]);

        $result = Auth::attempt($this->form);
        if ($result == true) {
            return redirect()->route('home');
        }
        session()->flash('errorMsg', 'Enter valid login information');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
