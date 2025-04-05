<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
class AdminManageBookings extends Component
{
    public $bookings;

    public function mount()
    {
        $this->bookings = Booking::with('facility', 'user')->get();
    }

    public function updateStatus($id, $status)
    {
        $booking = Booking::findOrFail($id);
        if($status=="approved")
        {
            $booking->facility->occupied;
        }
        else
        {
        $booking->facility->occupied--;    
        $booking->facility->save();
        }
        $booking->status = $status;
        $booking->save();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin-manage-bookings');
    }
}

