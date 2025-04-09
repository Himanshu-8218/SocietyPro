<div class="container mt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <h4>Generate Monthly Bill</h4>
    <div class="row mb-4">
        <div class="col-md-3">
            <select class="form-control" wire:model="selected_user">
                <option value="">Select Resident</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}-{{$user->usertype}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <input type="number" class="form-control" wire:model="amount" placeholder="Amount" />
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control" wire:model.lazy="billing_date" />
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary" wire:click="generateBill">Generate</button>
        </div>
    </div>

    <h5>All Bills</h5>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Resident</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bills as $bill)
                <tr>
                    <td>{{ $bill->user->name }}-{{$bill->user->usertype}}</td>
                    <td>₹{{ number_format($bill->amount, 2) }}</td>
                    <td>{{ $bill->billing_date }}</td>
                    <td>
                        <span class="badge bg-{{ $bill->status == 'paid' ? 'success' : 'danger' }}">{{ ucfirst($bill->status) }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $bills->links() }}
</div>
