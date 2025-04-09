<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileManagement extends Component
{
    public $name;
    public $email;
    public $contact;
    public $current_password;
    public $new_password;
    public $confirm_password;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->contact = $user->contact;
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'contact' => 'nullable|string|max:20',
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'contact' => $this->contact,
        ]);

        session()->flash('message', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|same:confirm_password',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            session()->flash('error', 'Current password is incorrect.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        session()->flash('message', 'Password changed successfully.');
        $this->reset(['current_password', 'new_password', 'confirm_password']);
    }

    public function render()
    {
        return view('livewire.profile-management');
    }
}

