<div class="container mt-5">

    <!-- Filter Dropdown -->
    <div class="mb-4 d-flex align-items-center gap-3">
        <label class="fw-semibold">Filter by Availability:</label>
        <select wire:model="availability" class="form-select w-auto">
            <option value="all">All</option>
            <option value="available">Available</option>
            <option value="occupied">Occupied</option>
        </select>
    </div>

    <!-- Units Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Building</th>
                    <th>Address</th>
                    <th>Floor</th>
                    <th>Unit</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($units as $unit)
                    <tr>
                        <td>{{ $unit->floor->building->name }}</td>
                        <td>{{ $unit->floor->building->address }}</td>
                        <td>Floor {{ $unit->floor->number }}</td>
                        <td>{{ $unit->unit_number }}</td>
                        <td>
                            <span class="badge bg-{{ $unit->status === 'available' ? 'success' : 'secondary' }}">
                                {{ ucfirst($unit->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($unit->status === 'available')
                                <button wire:click="buy({{ $unit->id }})" class="btn btn-sm btn-primary">
                                    Buy
                                </button>
                            @else
                                <span class="text-muted">Occupied</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No units found for the selected filter.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
