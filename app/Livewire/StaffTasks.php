<?php

// app/Livewire/StaffTasks.php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class StaffTasks extends Component
{
    public $tasks = [];

    public function mount()
    {
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = Task::where('user_id', Auth::id())->get();
    }

    public function updateStatus($taskId, $status)
    {
        $task = Task::where('id', $taskId)->where('user_id', Auth::id())->firstOrFail();
        $task->status = $status;
        $task->save();

        session()->flash('message', 'Task status updated successfully.');
        $this->loadTasks();
    }

    public function render()
    {
        return view('livewire.staff-tasks');
    }
}
