<?php

namespace App\Livewire\Admin;

use App\Models\Bill;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Carbon;

class BillingManager extends Component
{
    public $amount, $billing_date, $selected_user;

    public function generateBill()
    {
        $this->validate([
            'selected_user' => 'required',
            'amount' => 'required|numeric|min:0',
            'billing_date' => 'required|date',
        ]);

        Bill::create([
            'user_id' => $this->selected_user,
            'amount' => $this->amount,
            'billing_date' => $this->billing_date,
        ]);

        session()->flash('message', 'Bill generated successfully.');
        $this->reset();
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.admin.billing-manager', [
            'users' => User::whereIn('usertype',['Resident'])->get(),
            'bills' => Bill::with('user')->latest()->paginate(10)
        ]);
    }
}
