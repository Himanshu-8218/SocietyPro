<div class="container">
    <label>Filter by Availability: </label>
    <select wire:model="availability">
        <option value="all">All</option>
        <option value="available">Available</option>
        <option value="occupied">Occupied</option>
    </select>

    <table>
        <thead>
            <tr>
                <th>Building</th>
                <th>Address</th>
                <th>Floor</th>
                <th>Unit</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($units as $unit)
                <tr>
                    <td>{{ $unit->floor->building->name }}</td>
                    <td>{{ $unit->floor->building->address }}</td>
                    <td>{{ $unit->floor->number }}</td>
                    <td>{{ $unit->unit_number }}</td>
                    <td>{{ $unit->status }}</td>
                    <td>
                        @if($unit->status === 'available')
                            <button wire:click="buy({{ $unit->id }})">Buy</button>
                        @else
                            Occupied
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
