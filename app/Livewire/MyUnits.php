<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;

class MyUnits extends Component
{
    public $selectedUserId = [];

    public function sell($unitId)
    {
        $unit = Unit::findOrFail($unitId);
        $userId = $this->selectedUserId[$unitId] ?? null;

        if (!$userId) {
            session()->flash('message', 'Please select a user to sell to.');
            return;
        }

        
        if (User::find($userId)->usertype === 'Admin') {
            $unit->resident_id =null;
            $unit->status = 'available';
            Resident::where('user_id', Auth::id())->delete();
        }
        else{
            $unit->resident_id =$userId;
            Resident::where('user_id', Auth::id())->update(
                [
                    'user_id'=>$userId,
                ]
                );

        }

        $unit->save();

        session()->flash('message', 'Unit sold successfully.');

        unset($this->selectedUserId[$unitId]); // Reset just that dropdown

    }

    public function render()
    {
        $units = Auth::user()->ownedUnits()->with('floor.building')->get();
        $users = User::where('id', '!=', Auth::id())
            ->whereNotIn('usertype', ['Security', 'Staff'])
            ->get();

        return view('livewire.my-units', compact('units', 'users'));
    }
}
