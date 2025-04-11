<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function pay(Bill $bill)
    {
        if ($bill->user_id !== Auth::id() || $bill->status === 'paid') {
            abort(403);
        }
    
        $paypal = PayPal::setProvider();
        $paypal->setApiCredentials(config('paypal'));
        $accessToken = $paypal->getAccessToken();
        $paypal->setAccessToken($accessToken);
    
        $response = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => config('paypal.currency', 'USD'),
                    "value" => $bill->amount
                ],
                "description" => "Maintenance Bill #" . $bill->id
            ]],
            "application_context" => [
                "cancel_url" => route('resident/paypal/cancel'),
                "return_url" => route('resident/paypal/success') . '?bill_id=' . $bill->id
            ]
        ]);
    
        if (isset($response['id']) && $response['status'] === 'CREATED') {
            return redirect($response['links'][1]['href']);
        }
    
        return redirect()->route('resident/bill')->with('error', 'Unable to process payment.');
    }
    

    public function success(Request $request)
    {
        $bill = Bill::findOrFail($request->get('bill_id'));
    
        $paypal = PayPal::setProvider();
        $paypal->setApiCredentials(config('paypal'));
        $accessToken = $paypal->getAccessToken();
        $paypal->setAccessToken($accessToken);
    
        $response = $paypal->capturePaymentOrder($request->token);
    
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $bill->update(['status' => 'paid']);
            return redirect()->route('resident/bill')->with('message', 'Payment successful!');
        }
    
        return redirect()->route('resident/bill')->with('error', 'Payment failed.');
    }
    

    public function cancel()
    {
        return redirect()->route('resident/bill')->with('error', 'Payment was cancelled.');
    }

    public function downloadReceipt(Bill $bill)
    {
        if ($bill->user_id !== Auth::id() || $bill->status !== 'paid') {
            abort(403);
        }

        $pdf = PDF::loadView('resident.receipt', compact('bill'));
        return $pdf->download("receipt_bill_{$bill->id}.pdf");
    }
}
