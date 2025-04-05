<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;

class MyUnits extends Component
{
    public function render()
    {
        $units = Auth::user()->ownedUnits()->with('floor.building')->get();

        return view('livewire.my-units', compact('units'));
    }
}

