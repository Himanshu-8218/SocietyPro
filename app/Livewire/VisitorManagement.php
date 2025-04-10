<?php

namespace App\Livewire;

use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VisitorManagement extends Component
{
    public $name, $contact, $purpose,$date;
    public $visitors;

    public function mount()
    {
        $this->visitors = Visitor::latest()->get();
    }

    public function addVisitor()
    {
    $this->validate([
        'name' => 'required|string|max:255',
        'contact' => 'required|string|max:15',
        'purpose' => 'required|string|max:255',
        'date'=>'required',
    ]);

    $status = (Auth::user()->usertype == 'Security') ? 'approved' : 'pending';

    Visitor::create([
        'name' => $this->name,
        'contact' => $this->contact,
        'purpose' => $this->purpose,
        'resident_id' => Auth::id(),
        'date'=>$this->date,
        'status' => $status,
        'approved_by' => (Auth::user()->role == 'security') ? Auth::id() : null,
    ]);

    session()->flash('message', 'Visitor Registered Successfully!');
    $this->reset(['name', 'contact', 'purpose']);
    $this->mount();
    }


    public function approveVisitor($id)
    {
        Visitor::where('id', $id)->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
        ]);
        $this->mount();
    }

    public function denyVisitor($id)
    {
        Visitor::where('id', $id)->update([
            'status' => 'denied',
            'approved_by' => Auth::id(),
        ]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.visitor-management');
    }
}

