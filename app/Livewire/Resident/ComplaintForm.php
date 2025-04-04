<?php

namespace App\Livewire\Resident;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

namespace App\Livewire\Resident;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ComplaintForm extends Component
{
    public $unreads, $notifications;

    public function mount()
    {
        $user = Auth::user();
        // dd($user);
        // Fetch notifications
        $this->unreads = $user->unreadNotifications->where('type','App\Notifications\ComplaintStatusUpdate');
        $this->notifications = $user->notifications->where('type','App\Notifications\ComplaintStatusUpdate');
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications->find($id);
        if ($notification) {
            $notification->markAsRead();
        }
        
        // Refresh component data after marking as read
        $this->mount();
    }

    public function render()
    {
        return view('livewire.resident.complaint-form');
    }
}
