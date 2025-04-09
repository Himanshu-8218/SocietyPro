<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class PaymentController extends Controller
{
    // Handle successful payment
    public function paymentSuccess($billId)
    {
        // Mark the bill as paid
        $bill = Bill::findOrFail($billId);
        $bill->status = 'paid';
        $bill->save();

        return view('payment-success', ['bill' => $bill]);
    }

    // Handle cancelled payment
    public function paymentCancel($billId)
    {
        return view('payment-cancel', ['billId' => $billId]);
    }

    // Generate and download PDF invoice
    public function downloadInvoice($billId)
    {
        $bill = Bill::with('user')->findOrFail($billId);

        // Generate the PDF using DOMPDF
        $dompdf = new Dompdf();
        $dompdf->setOptions(new Options(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]));

        // Prepare HTML for the invoice
        $html = view('resident.invoice', ['bill' => $bill])->render();

        // Load HTML to DOMPDF
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Stream the PDF as a download
        return $dompdf->stream('invoice-' . $bill->id . '.pdf');
    }
}
