<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Complaint;
use Illuminate\Support\Facades\Log;

class ManageComplaints extends Component
{
    public $complaints;

    public $status;
    public $complaintId;

    public function mount()
    {
        $this->complaints = Complaint::all();
    }

    public function updateStatus($id)
    {
        $complaint = Complaint::find($id);
        $complaint->status = $this->status;
        $complaint->save();

        // Send notification about the status change
        $this->sendNotification($complaint);

        // Refresh the complaint list
        $this->complaints = Complaint::all();
    }

    public function sendNotification($complaint)
    {
    // Ensure user is loaded
    $complaint = Complaint::with('user')->find($complaint->id);

    if (!$complaint || !$complaint->user) {
        Log::error("User not found for complaint ID: {$complaint->id}");
        return;
    }

    $message = "Your complaint status has been updated to: " . $complaint->status;
    $complaint->user->notify(new \App\Notifications\ComplaintStatusUpdated($message));
}
    public function render()
    {
        return view('livewire.manage-complaints');
    }
}
