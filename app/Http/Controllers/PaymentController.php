<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

class PaymentController extends Controller
{
    public function success(Request $request, $billId)
    {
        $bill = Bill::findOrFail($billId);
        $bill->update(['status' => 'paid', 'transaction_id' => $request->transaction_id]);

        return redirect()->route('billing.index')->with('message', 'Payment successful!');
    }

    public function cancel()
    {
        return redirect()->route('billing.index')->with('message', 'Payment cancelled.');
    }
}
