<div class="container mt-5">
    <h2 class="fw-semibold mb-4">My Owned Units</h2>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Building</th>
                    <th>Address</th>
                    <th>Floor</th>
                    <th>Unit</th>
                    <th>Sell To</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($units as $unit)
                    <tr>
                        <td>{{ $unit->floor->building->name }}</td>
                        <td>{{ $unit->floor->building->address }}</td>
                        <td>Floor {{ $unit->floor->number }}</td>
                        <td>{{ $unit->unit_number }}</td>
                        <td>
                            <select wire:model.lazy="selectedUserId.{{ $unit->id }}" class="form-select">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->usertype }})</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button wire:click="sell({{ $unit->id }})"
                                    wire:loading.attr="disabled"
                                    class="btn btn-danger btn-sm"
                                    @if(empty($selectedUserId[$unit->id])) disabled @endif>
                                Sell
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
