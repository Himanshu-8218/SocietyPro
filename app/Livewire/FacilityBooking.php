<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FacilityBooking extends Component
{
    public $facilities;
    public $selectedFacility;
    public $date, $start_time, $end_time;
    public $occupiedSlots = 0;
    public $availableSlots = 0;

    public function mount()
    {
        $this->facilities = Facility::all();
    }

    public function openFacility($facilityId)
    {
        $this->selectedFacility = Facility::find($facilityId);
        $this->reset(['date', 'start_time', 'end_time', 'occupiedSlots', 'availableSlots']);
    }

    public function updatedDate()
    {
        if ($this->selectedFacility && $this->date) {
            $this->loadAvailability();
        }
    }

    public function loadAvailability()
    {
        $bookings = Booking::where('facility_id', $this->selectedFacility->id)
            ->where('date', $this->date)
            ->get();

        $this->occupiedSlots = $bookings->count();
        $this->availableSlots = max(0, $this->selectedFacility->total_slots - $this->occupiedSlots);
    }

    public function submitBooking()
    {
        $this->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // Reload availability to ensure latest data
        $this->loadAvailability();



        // Check if the selected time overlaps with any existing bookings
        $overlapping = Booking::where('facility_id', $this->selectedFacility->id)
            ->where('date', $this->date)
            ->where(function ($query) {
                $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                    ->orWhereBetween('end_time', [$this->start_time, $this->end_time])
                    ->orWhere(function ($q) {
                        $q->where('start_time', '<=', $this->start_time)
                        ->where('end_time', '>=', $this->end_time);
                    });
            })
            ->exists();

        if ($overlapping) {
            session()->flash('error', 'The selected time overlaps with an existing booking.');
            return;
        }

        // Save the booking
        Booking::create([
            'user_id'=>Auth::id(),
            'facility_id' => $this->selectedFacility->id,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);
        $this->selectedFacility->occupied++;
        $this->selectedFacility->save();

        session()->flash('message', 'Booking successful!');
        $this->cancelSelection();
    }


    public function cancelSelection()
    {
        $this->selectedFacility = null;
        $this->reset(['date', 'start_time', 'end_time', 'occupiedSlots', 'availableSlots']);
    }

    public function render()
    {
        return view('livewire.facility-booking');
    }
}
