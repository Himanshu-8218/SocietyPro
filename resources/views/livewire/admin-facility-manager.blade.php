<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Add New Facility</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="addFacility" class="mb-6">
        <div class="mb-4">
            <label class="block font-medium">Facility Name</label>
            <input type="text" wire:model="name" class="w-full border rounded p-2" placeholder="e.g. Clubhouse">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium">Description</label>
            <input type="text" wire:model="description" class="w-full border rounded p-2" placeholder="e.g. Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias id, optio, assumenda aspernatur">
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium">Total Slots</label>
            <input type="number" wire:model="total_slots" class="w-full border rounded p-2">
            @error('total_slots') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">Add Facility</button>
    </form>

    <h3 class="text-lg font-semibold mb-2">Existing Facilities</h3>
    <table class="w-full border-collapse table-auto">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Description</th>
                <th class="px-4 py-2 border">Total Slots</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facilities as $facility)
                <tr>
                    <td class="px-4 py-2 border">{{ $facility->name }}</td>
                    <td class="px-4 py-2 border">{{ $facility->description }}</td>
                    <td class="px-4 py-2 border">{{ $facility->total_slots }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
