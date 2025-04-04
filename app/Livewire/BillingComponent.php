<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class BillingComponent extends Component
{
    public $amount, $due_date;

    public function createBill()
    {
        $this->validate([
            'amount' => 'required|numeric|min:1',
            'due_date' => 'required|date|after:today',
        ]);

        Bill::create([
            'resident_id' => Auth::id(),
            'amount' => $this->amount,
            'due_date' => $this->due_date,
            'status' => 'pending',
        ]);

        session()->flash('message', 'Bill generated successfully!');
        $this->reset(['amount', 'due_date']);
    }

    public function pay($billId)
    {
        $bill = Bill::findOrFail($billId);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $bill->amount
                    ]
                ]
            ],
            "application_context" => [
                "cancel_url" => route('billing.cancel'),
                "return_url" => route('billing.success', ['billId' => $bill->id])
            ]
        ]);

        if (!isset($response['id'])) {
            session()->flash('message', 'Payment creation failed.');
            return;
        }

        return redirect($response['links'][1]['href']);
    }

    public function paymentSuccess($billId, $transactionId)
    {
        $bill = Bill::findOrFail($billId);
        $bill->update(['status' => 'paid', 'transaction_id' => $transactionId]);

        session()->flash('message', 'Payment successful!');
    }

    public function render()
    {
        $bills = Bill::where('resident_id', Auth::id())->get();
        return view('livewire.billing-component', compact('bills'));
    }
}
