<?php
namespace App\Livewire\Resident;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    public function markAsRead($id)
    {
        Auth::user()->notifications->find($id)->markAsRead();
    }

    public function render()
    {
        return view('livewire.resident.notifications', [
            'unreadNotifications' => Auth::user()->unreadNotifications->where('type','App\Notifications\AdminNotification'),
            'allNotifications' => Auth::user()->notifications->where('type','App\Notifications\AdminNotification'),
        ]);
    }
}
