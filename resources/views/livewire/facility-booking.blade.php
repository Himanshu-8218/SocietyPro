<div class="container mt-5">
    <h2 class="mb-4">Facilities</h2>

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
                    <strong>{{ $facility->name }}</strong>
                    <button 
                        class="btn btn-sm btn-primary"
                        wire:click="openFacility({{ $facility->id }})"
                    >
                        Add
                    </button>
                </div>

                @if ($selectedFacility && $selectedFacility->id === $facility->id)
                    <div class="mt-3 border-top pt-3">
                        <div class="mb-3">
                            <label class="form-label">Select Date</label>
                            <input type="date" wire:model="date" class="form-control">
                        </div>

                            <div class="alert alert-info">
                                <p><strong>Total Slots:</strong> {{ $facility->total_slots}}</p>
                                {{-- <p><strong>Occupied:</strong> {{ $occupiedSlots }}</p> --}}
                                <p><strong>Available:</strong> {{ $facility->occupied }}</p>
                            </div>

                        <div class="mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="time" wire:model="start_time" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">End Time</label>
                            <input type="time" wire:model="end_time" class="form-control">
                        </div>

                        <div class="d-flex gap-2">
                            @if ($facility->total_slots >$facility->occupied)
                                <button wire:click="submitBooking" class="btn btn-success">Apply</button>
                            @else
                                <button type="button" class="btn btn-danger" disabled>Not Enough Slot</button>
                            @endif
                            <button wire:click="cancelSelection" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
