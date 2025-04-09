<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Bill #{{ $bill->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-header, .invoice-footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-details {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details th, .invoice-details td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="invoice-header">
        <h2>Invoice for Bill #{{ $bill->id }}</h2>
        <p>Generated on {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
    </div>

    <table class="invoice-details">
        <tr>
            <th>Resident</th>
            <td>{{ $bill->user->name }} ({{ $bill->user->usertype }})</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>₹{{ number_format($bill->amount, 2) }}</td>
        </tr>
        <tr>
            <th>Billing Date</th>
            <td>{{ $bill->billing_date }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($bill->status) }}</td>
        </tr>
    </table>

    <div class="invoice-footer">
        <p>Thank you for your payment!</p>
    </div>

</body>
</html>
