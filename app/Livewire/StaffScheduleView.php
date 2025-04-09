<?php


namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StaffShift;
use Illuminate\Support\Facades\Auth;

class StaffScheduleView extends Component
{
    use WithPagination;

    public function render()
    {
        $userId = Auth::id();

        $shifts = StaffShift::where('user_id', $userId)
                    ->orderBy('date', 'desc')
                    ->paginate(7);

        return view('livewire.staff-schedule-view', compact('shifts'));
    }
}
