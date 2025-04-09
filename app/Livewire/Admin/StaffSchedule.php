<?php
namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\StaffShift;
use Livewire\Component;
use Livewire\WithPagination;

class StaffSchedule extends Component
{
    use WithPagination;

    public $staff;
    public $shift_type, $shift_date, $selected_staff;

    public function mount()
    {
        $this->staff = User::whereIn('usertype', ['Security', 'Staff'])->get();
    }

    public function assignShift()
    {
        $this->validate([
            'selected_staff' => 'required',
            'shift_type' => 'required',
            'shift_date' => 'required|date',
        ]);

        StaffShift::create([
            'user_id' => $this->selected_staff,
            'shift' => $this->shift_type,
            'date' => $this->shift_date,
        ]);

        session()->flash('message', 'Shift assigned successfully!');
        $this->reset(['shift_type', 'shift_date', 'selected_staff']);
    }

    public function render()
    {
        $schedules = StaffShift::with('user')->orderBy('date', 'desc')->paginate(5);
        return view('livewire.admin.staff-schedule', compact('schedules'));
    }
}
