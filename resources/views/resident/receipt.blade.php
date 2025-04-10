<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; }
        .receipt-box { padding: 20px; border: 1px solid #eee; }
        .title { font-size: 24px; font-weight: bold; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="receipt-box">
        <div class="title">Maintenance Payment Receipt</div>
        <p><strong>Bill ID:</strong> {{ $bill->id }}</p>
        <p><strong>Name:</strong> {{ $bill->user->name }}</p>
        <p><strong>Billing Date:</strong> {{ \Carbon\Carbon::parse($bill->billing_date)->format('F Y') }}</p>
        <p><strong>Amount Paid:</strong> ${{ number_format($bill->amount, 2) }}</p>
        <p><strong>Status:</strong> Paid</p>
        <p><strong>Paid On:</strong> {{ $bill->updated_at->format('d M Y, h:i A') }}</p>
        <hr>
        <p>Thank you for your payment!</p>
    </div>
</body>
</html>
