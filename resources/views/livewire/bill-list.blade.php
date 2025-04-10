<div class="container mt-4">
    <strong class="fs-3 mb-3">Your Bills</strong>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Due Bills Section --}}
    <h2 class="mt-4 fs-5">Due Bills</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Billing Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($bills->where('status', 'due') as $bill)
            <tr>
                <td>{{ \Carbon\Carbon::parse($bill->billing_date)->format('M Y') }}</td>
                <td>${{ number_format($bill->amount, 2) }}</td>
                <td><span class="badge bg-danger">Due</span></td>
                <td>
                    <a href="{{ route('resident/pay', $bill->id) }}" class="btn btn-primary btn-sm">Pay Now</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No due bills.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Paid Bills Section --}}
    <h2 class="mt-5 fs-5">Paid Bills</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Billing Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($bills->where('status', 'paid') as $bill)
            <tr>
                <td>{{ \Carbon\Carbon::parse($bill->billing_date)->format('M Y') }}</td>
                <td>${{ number_format($bill->amount, 2) }}</td>
                <td><span class="badge bg-success">Paid</span></td>
                <td>
                    <a href="{{ route('resident/receipt', $bill->id) }}" class="btn btn-success btn-sm">Download Receipt</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No paid bills.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
