<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Facility;

class AdminFacilityManager extends Component
{
    public $name, $description, $slot, $total_slots;
    public $facilities;
    public $slots = ['5am-7am', '7am-9am', '4pm-6pm', '6pm-8pm', '8pm-10pm'];

    public function mount()
    {
        $this->fetchFacilities();
    }

    public function fetchFacilities()
    {
        $this->facilities = Facility::all();
    }

    public function addFacility()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'slot' => 'required|in:5am-7am,7am-9am,4pm-6pm,6pm-8pm,8pm-10pm',
            'total_slots' => 'required|integer|min:1',
        ]);

        Facility::create([
            'name' => $this->name,
            'description' => $this->description,
            'slot' => $this->slot,
            'total_slots' => $this->total_slots,
        ]);

        session()->flash('message', 'Facility added successfully!');
        $this->reset(['name', 'description', 'slot', 'total_slots']);
        $this->fetchFacilities();
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.admin-facility-manager');
    }
}
