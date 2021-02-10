<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public $form = [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function submit()
    {
        $this->validate([
            'form.name' => 'required',
            'form.email' => 'required|email',
            'form.password' => 'required|confirmed|min:8',
        ]);

        User::create($this->form);
        Auth::attempt($this->form);
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
