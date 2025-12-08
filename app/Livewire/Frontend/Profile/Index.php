<?php

namespace App\Livewire\Frontend\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Index extends Component
{
    public $activeTab = 'dashboard';

    // Profile Edit Properties
    public $name;
    public $email;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('success', 'Profile updated successfully!');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('password_success', 'Password changed successfully!');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.frontend.profile.index');
    }
}
