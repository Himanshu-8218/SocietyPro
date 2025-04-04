<?php

namespace App\Livewire;
use App\Models\Facility;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FacilityBooking extends Component
{
    public $occupiedSlots = 0;
    public $availableSlots = 0;
    public $facilities;
    public $facility_id, $date, $start_time, $end_time;

    public function mount()
    {
        $this->facilities = Facility::all();
    }
    
    public function updatedDate()
    {
        $this->updateSlotAvailability();
    }
    
    public function updatedFacilityId()
    {
        $this->updateSlotAvailability();
    }
    
    public function updateSlotAvailability()
    {
        if ($this->facility_id && $this->date) {
            $this->occupiedSlots = Booking::where('facility_id', $this->facility_id)
                ->where('date', $this->date)
                ->whereIn('status', ['pending', 'approved'])
                ->count();
    
            $facility = Facility::find($this->facility_id);
            $this->availableSlots = $facility->total_slots - $this->occupiedSlots;
        }
    }
    
    public function book()
    {
        $this->validate([
            'facility_id' => 'required|exists:facilities,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
    
        $this->updateSlotAvailability();
    
        if ($this->availableSlots <= 0) {
            session()->flash('error', 'No available slots for this date.');
            return;
        }
    
        Booking::create([
            'user_id' => Auth::id(),
            'facility_id' => $this->facility_id,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => 'pending',
        ]);
    
        session()->flash('message', 'Booking request submitted!');
    }
    function render()
    {
        return view('livewire.facility-booking');
    }
}
