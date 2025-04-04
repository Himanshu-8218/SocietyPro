<div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-semibold mb-4">Book a Facility</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="book">
        <div class="mb-4">
            <label class="block font-medium">Select Facility</label>
            <select wire:model="facility_id" class="w-full border rounded p-2">
                <option value="">-- Choose --</option>
                @foreach ($facilities as $facility)
                    <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                @endforeach
            </select>
        </div>
        

        <div class="mb-4">
            <label class="block font-medium">Date</label>
            <input type="date" wire:model="date" class="w-full border rounded p-2">
        </div>

        @if ($facility_id && $date)
        <div class="mb-4 p-3 bg-gray-100 rounded">
            <p><strong>Total Slots:</strong> {{ $occupiedSlots + $availableSlots }}</p>
            <p><strong>Occupied:</strong> {{ $occupiedSlots }}</p>
            <p><strong>Available:</strong> {{ $availableSlots }}</p>
        </div>
        @endif

        <div class="mb-4">
            <label class="block font-medium">Start Time</label>
            <input type="time" wire:model="start_time" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium">End Time</label>
            <input type="time" wire:model="end_time" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Book Now</button>
    </form>
</div>
