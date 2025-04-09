<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\WithPagination;

class AttendanceReport extends Component
{
    use WithPagination;

    public $count;

    public function mount()
    {
        $this->count = User::whereIn('usertype', ['Security', 'Staff'])->count();
    }

    public function render()
    {
        $users=User::whereIn('usertype',['Security','Staff'])->get();
        if (Auth::user()->usertype != 'Admin') {
            $attendances = Attendance::where('user_id', Auth::id())
                ->orderBy('date', 'desc')->get();
        } else {
            $attendances = Attendance::whereIn('usertype', ['Security', 'Staff'])
                ->orderBy('date', 'desc')
                ->paginate($this->count);
        }
        // dd($users);
        return view('livewire.attendance-report', [
            'attendances' => $attendances,
            'users'=>$users,
        ]);
    }
}
