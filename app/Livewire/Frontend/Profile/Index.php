<?php

namespace App\Livewire\Frontend\Profile;

use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $activeTab = 'dashboard';

    // Dashboard Stats
    public $totalOrdersCount = 0;
    public $pendingOrdersCount = 0;
    public $completedOrdersCount = 0;

    // Profile Edit Properties
    public $name;
    public $email;
    public $phone; // Added phone if your user model has it

    // Password Change Properties
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        // $this->phone = $user->phone; 

        // Calculate Stats
        $this->totalOrdersCount = Order::where('user_id', $user->id)->count();

        $this->pendingOrdersCount = Order::where('user_id', $user->id)
            ->where('order_status', OrderStatus::Pending)
            ->count();

        // Assuming 'completed' or 'delivered' counts as success
        $this->completedOrdersCount = Order::where('user_id', $user->id)
            ->where('order_status', OrderStatus::Delivered)
            ->count();
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage(); // Reset pagination when switching tabs
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
        return $this->redirect(route('login'), navigate: true);
    }

    public function render()
    {
        // Fetch Orders for the logged-in user
        $orders = [];
        if ($this->activeTab == 'orders') {
            $orders = Order::where('user_id', Auth::id())
                ->latest()
                ->paginate(5);
        }

        // Try to get the latest order for the Address Tab display
        $lastOrder = null;
        if ($this->activeTab == 'address') {
            $lastOrder = Order::where('user_id', Auth::id())->latest()->first();
        }

        return view('livewire.frontend.profile.index', [
            'orders' => $orders,
            'lastOrder' => $lastOrder
        ]);
    }
}
