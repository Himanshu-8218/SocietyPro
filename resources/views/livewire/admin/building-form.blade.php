<div class="container">
    <form wire:submit.prevent="save">
        <input type="text" wire:model="name" placeholder="Building Name" required>
        <input type="text" wire:model="address" placeholder="Address" required>
        <button type="submit">{{ $building_id ? 'Update' : 'Add' }} Building</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Name</th><th>Address</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buildings as $building)
                <tr>
                    <td>{{ $building->name }}</td>
                    <td>{{ $building->address }}</td>
                    <td>
                        <button wire:click="edit({{ $building->id }})">Edit</button>
                        <button wire:click="delete({{ $building->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
