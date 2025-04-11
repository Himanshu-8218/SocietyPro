<div class="container mt-5">
    <h2 class="mb-4">Facility Booking</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="list-group">
        @foreach ($facilities as $facility)
            <div class="list-group-item mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <strong>{{ $facility->name }} ({{ $facility->slot }})</strong>
                    <button class="btn btn-sm btn-primary" wire:click="openFacility({{ $facility->id }})">Book</button>
                </div>

                @if ($selectedFacility && $selectedFacility->id === $facility->id)
                    <div class="mt-3 border-top pt-3">
                        <div class="mb-3">
                            <label class="form-label">Select Date</label>
                            <input type="date" wire:model.lazy="date" class="form-control">
                        </div>

                        @if ($date)
                            <div class="alert alert-info">
                                <p><strong>Slot:</strong> {{ $facility->slot }}</p>
                                <p><strong>Total Slots:</strong> {{ $facility->total_slots }}</p>
                                <p><strong>Available:</strong> {{ $facility->total_slots -$facility->occupied }}</p>
                            </div>
                        @endif

                        <div class="d-flex gap-2">
                            @if (max(0,$facility->total_slots -$facility->occupied) > 0 && $date)
                                <button wire:click="submitBooking" class="btn btn-success">Book Now</button>
                            @else
                                <button class="btn btn-danger" disabled>Full</button>
                            @endif
                            <button wire:click="cancelSelection" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
