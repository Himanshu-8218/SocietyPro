<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Task;

class TaskAssignment extends Component
{
    public $staff_id;
    public $task_description;
    public $maintenanceStaff;
    public $tasks;

    public function mount()
    {
        $this->maintenanceStaff = User::where('usertype', 'Staff')->get();
        $this->loadTasks();
    }

    public function assignTask()
    {
        $this->validate([
            'staff_id' => 'required|exists:users,id',
            'task_description' => 'required|string|max:255',
        ]);

        Task::create([
            'user_id' => $this->staff_id,
            'description' => $this->task_description,
            'status' => 'pending',
        ]);

        session()->flash('message', 'Task assigned successfully.');
        $this->reset(['staff_id', 'task_description']);
        $this->loadTasks(); // Reload tasks after submission
    }

    public function loadTasks()
    {
        $this->tasks = Task::with('user')->latest()->get();
    }

    public function render()
    {
        return view('livewire.task-assignment');
    }
}
