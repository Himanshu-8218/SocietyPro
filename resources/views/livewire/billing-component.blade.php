<div>
    <h2>Billing & Payments</h2>

    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="createBill">
        <input type="number" wire:model="amount" placeholder="Enter Amount" required>
        <input type="date" wire:model="due_date" required>
        <button type="submit">Generate Bill</button>
    </form>

    <h3>Your Bills</h3>
    <table>
        <tr>
            <th>Amount</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach($bills as $bill)
        <tr>
            <td>{{ $bill->amount }}</td>
            <td>{{ $bill->due_date }}</td>
            <td>{{ $bill->status }}</td>
            <td>
                @if($bill->status === 'pending')
                    <button wire:click="pay({{ $bill->id }})">Pay Now</button>
                @else
                    <span>Paid</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
