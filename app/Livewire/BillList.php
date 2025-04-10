<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bill;
use Illuminate\Support\Facades\Auth;

class BillList extends Component
{
    public function render()
    {
        $bills = Bill::where('user_id', Auth::id())->latest()->get();
        return view('livewire.bill-list', compact('bills'));
    }
}
