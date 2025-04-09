<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form wire:submit.prevent="save">
        <select wire:model="building_id" required>
            <option value="">Select Building</option>
            @foreach($buildings as $building)
                <option value="{{ $building->id }}">{{ $building->name }}</option>
            @endforeach
        </select>
        <input type="number" wire:model.defer="number" placeholder="Floor Number" required>
        <button type="save">{{ $floor_id ? 'Update' : 'Add' }} Floor</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Building</th><th>Floor No</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($floors as $floor)
                <tr>
                    <td>{{ $floor->building->name }}</td>
                    <td>{{ $floor->number }}</td>
                    <td>
                        <button wire:click="edit({{ $floor->id }})">Edit</button>
                        <button wire:click="delete({{ $floor->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
