<?php

namespace App\Livewire\Frontend\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            // Redirect to intended page or home
            return redirect()->intended(route('home'));
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.frontend.auth.login');
    }
}
