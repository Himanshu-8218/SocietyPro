<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AttendanceManager extends Component
{
    public $date;
    public $attendances = [];
    // public $usertype;

    public function mount()
    {
        $this->date = now()->toDateString();
        $this->loadAttendances();
    }

    public function loadAttendances()
    {
        $this->reset('attendances');

    $users = User::whereIn('usertype', ['Staff', 'Security'])->get();
    $this->attendances = $users->mapWithKeys(function ($user) {
        $attendance = Attendance::where('user_id', $user->id)
        ->whereDate('date', $this->date)
        ->first();
        // dd($attendance);
        return [$user->id => [
            'name' => $user->name,
            'usertype' => $user->usertype,
            'status' => $attendance ? $attendance->status : 'absent',
        ]];
    })->toArray();
    // dd($this->attendances);
    }

    public function updatedDate()
    {
    $this->date = Carbon::parse($this->date)->toDateString(); // normalize
    $this->loadAttendances();
    }

    



    public function markAttendance()
    {
        foreach ($this->attendances as $userId => $attendanceData) {
            $users = User::find($userId);
            Attendance::updateOrCreate(
                ['user_id' => $userId, 'date' => $this->date,'usertype'=>$users->usertype],
                ['status' => $attendanceData['status']]
            );
        }

        session()->flash('message', 'Attendance updated successfully.');
        $this->loadAttendances();
    }

    public function render()
    {
        return view('livewire.attendance-manager');
    }
}
