<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class FacilityBooking extends Component
{
    public $facilities;
    public $selectedFacility;
    public $date;
    public $availableSlots = 0;
    public $occupiedSlots = 0;

    public function mount()
    {
        $this->facilities = Facility::all();
    }

    public function openFacility($id)
    {
        $this->selectedFacility = Facility::findOrFail($id);
        $this->reset(['date', 'availableSlots', 'occupiedSlots']);
    }

    public function updatedDate()
    {
        if ($this->selectedFacility && $this->date) {
            $this->loadAvailability();
        }
    }

    public function loadAvailability()
    {
        $this->occupiedSlots = Booking::where('facility_id', $this->selectedFacility->id)
            ->where('date', $this->date)
            ->where('slot', $this->selectedFacility->slot)
            ->count();

    }

    public function submitBooking()
    {
        $this->validate([
            'date' => 'required|date',
        ]);

        $slot = $this->selectedFacility->slot;

        $this->occupiedSlots = Booking::where('facility_id', $this->selectedFacility->id)
            ->where('date', $this->date)
            ->where('slot', $slot)
            ->count();

        if ($this->occupiedSlots >= $this->selectedFacility->total_slots) {
            session()->flash('error', 'No slots available for this date and time.');
            return;
        }

        Booking::create([
            'user_id' => Auth::id(),
            'facility_id' => $this->selectedFacility->id,
            'date' => $this->date,
            'slot' => $slot,
            'status' => 'pending',
        ]);
        $facility=Facility::where('id',$this->selectedFacility->id)->get();
        // dd($facility);
        $facility->first()->occupied=$facility->first()->occupied+1;
        $facility->first()->save();

        session()->flash('message', 'Booking successful!');
        $this->cancelSelection();
    }

    public function cancelSelection()
    {
        $this->selectedFacility = null;
        $this->reset(['date', 'availableSlots', 'occupiedSlots']);
    }

    public function render()
    {
        return view('livewire.facility-booking');
    }
}
