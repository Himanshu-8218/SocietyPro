<?php

namespace App\Livewire;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ComplaintForm extends Component
{
    public $description;

    protected $rules = [
        'description' => 'required|min:10',
    ];

    public function submitComplaint()
    {
        $this->validate();

        // Store the complaint
        Complaint::create([
            'user_id' => Auth::user()->id,
            'description' => $this->description,
            'status' => 'Pending',
        ]);

        // You can send notification or a session message after submission
        session()->flash('message', 'Your complaint has been submitted successfully.');

        // Optionally reset form fields
        $this->reset('description');
    }
    public function render()
    {
        return view('livewire.complaint-form');
    }
}
