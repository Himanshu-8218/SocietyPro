<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-lg border">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Facility</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="addFacility" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Facility Name</label>
            <input type="text" wire:model="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <input type="text" wire:model="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            @error('description') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Slot</label>
            <select wire:model="slot" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring focus:ring-blue-300">
                <option value="">-- Select Slot --</option>
                @foreach ($slots as $s)
                    <option value="{{ $s }}">{{ $s }}</option>
                @endforeach
            </select>
            @error('slot') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Total Slots</label>
            <input type="number" wire:model="total_slots" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            @error('total_slots') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-success mt-2 mb-2">
                Add Facility
            </button>
        </div>
    </form>

    <h3 class="text-xl font-semibold text-gray-800 mt-10 mb-4">Existing Facilities</h3>

    <div class="overflow-x-auto">
        <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Description</th>
                    <th class="px-4 py-3 text-left">Slot</th>
                    <th class="px-4 py-3 text-left">Total Slots</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($facilities as $facility)
                    <tr>
                        <td class="px-4 py-2">{{ $facility->name }}</td>
                        <td class="px-4 py-2">{{ $facility->description }}</td>
                        <td class="px-4 py-2">{{ $facility->slot }}</td>
                        <td class="px-4 py-2">{{ $facility->total_slots }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">No facilities available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
