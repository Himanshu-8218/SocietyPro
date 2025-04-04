<div class="max-w-5xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-semibold mb-4">Manage Facility Bookings</h2>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2 border">User</th>
                <th class="px-4 py-2 border">Facility</th>
                <th class="px-4 py-2 border">Date</th>
                <th class="px-4 py-2 border">Time</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td class="px-4 py-2 border">{{ $booking->user->name }}</td>
                    <td class="px-4 py-2 border">{{ $booking->facility->name }}</td>
                    <td class="px-4 py-2 border">{{ $booking->date }}</td>
                    <td class="px-4 py-2 border">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                    <td class="px-4 py-2 border capitalize">{{ $booking->status }}</td>
                    <td class="px-4 py-2 border">
                        @if ($booking->status !== 'approved')
                            <button wire:click="updateStatus({{ $booking->id }}, 'approved')" class="bg-green-500 text-black px-2 py-1 rounded">Approve</button>
                        @endif
                        @if ($booking->status !== 'cancelled')
                            <button wire:click="updateStatus({{ $booking->id }}, 'cancelled')" class="bg-red-500 text-black px-2 py-1 rounded">Cancel</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
