<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Facility;

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

        // Adjust facility's occupied count
        if($status==='cancelled')
        {
        $facility=Facility::where('id',$booking->facility->id)->get();
        // dd($facility);
        $facility->first()->occupied=$facility->first()->occupied-1;
        $facility->first()->save();
        }

        $booking->facility->save();
        $booking->status = $status;
        $booking->save();

        $this->mount(); // Refresh bookings list
    }

    public function render()
    {
        return view('livewire.admin-manage-bookings');
    }
}
