<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Unit;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;


class ResidentPropertyList extends Component
{
    public $availability = 'all';

    public function buy($unitId)
    {
        $unit = Unit::findOrFail($unitId);

        // Check if already bought
        if ($unit->status === 'occupied') {
            session()->flash('error', 'This unit is already occupied.');
            return;
        }

        // Create resident ownership
        Resident::create([
            'user_id' => Auth::id(),
            'unit_id' => $unitId,
        ]);

        // Mark unit as occupied
        $unit->update(['status' => 'occupied']);

        session()->flash('success', 'Unit successfully purchased.');
    }

    public function render()
    {
        $query = Unit::with('floor.building');

        if ($this->availability === 'available') {
            $query->where('status', 'available');
        } elseif ($this->availability === 'occupied') {
            $query->where('status', 'occupied');
        }

        return view('livewire.resident-property-list', [
            'units' => $query->get(),
        ]);
    }
}

