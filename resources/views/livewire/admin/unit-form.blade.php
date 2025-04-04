<div class="container">
    <form wire:submit.prevent="save">
        <select wire:model="floor_id" required>
            <option value="">Select Floor</option>
            @foreach($floors as $floor)
                <option value="{{ $floor->id }}">
                    {{ $floor->building->name }} - Floor {{ $floor->number }}
                </option>
            @endforeach
        </select>

        <input type="text" wire:model="unit_number" placeholder="Unit Number" required>
        <select wire:model="status">
            <option value="available">Available</option>
            <option value="occupied">Occupied</option>
        </select>

        <button type="submit">{{ $unit_id ? 'Update' : 'Add' }} Unit</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Building</th><th>Floor</th><th>Unit</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($units as $unit)
                <tr>
                    <td>{{ $unit->floor->building->name }}</td>
                    <td>{{ $unit->floor->number }}</td>
                    <td>{{ $unit->unit_number }}</td>
                    <td>{{ $unit->status }}</td>
                    <td>
                        <button wire:click="edit({{ $unit->id }})">Edit</button>
                        <button wire:click="delete({{ $unit->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
