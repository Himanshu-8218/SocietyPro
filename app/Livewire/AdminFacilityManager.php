<?php

namespace App\Livewire;
use App\Models\Facility;
use Livewire\Component;

class AdminFacilityManager extends Component
{
    public $name, $total_slots,$description;
    public $facilities;

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
            'total_slots' => 'required|integer|min:1',
            'description'=>'required|string|min:10',
        ]);

        Facility::create([
            'name' => $this->name,
            'total_slots' => $this->total_slots,
            'description'=>$this->description,
        ]);

        session()->flash('message', 'Facility added successfully!');
        $this->reset(['name', 'total_slots','description']);
        $this->fetchFacilities();
    }
    public function render()
    {
        return view('livewire.admin-facility-manager');
    }
}
