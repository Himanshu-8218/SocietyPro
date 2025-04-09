<div class="container mt-4">
    <!-- Add Building Form -->
    <div class="mb-4">
        <input type="text" wire:model.defer="newBuildingName" placeholder="Building Name" class="form-control mb-2">
        <input type="text" wire:model.defer="newBuildingAddress" placeholder="Building Address" class="form-control mb-2">
        <button wire:click="addBuilding" class="btn btn-primary">Add Building</button>
    </div>

    <!-- Buildings Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buildings as $building)
                <tr wire:key="building-{{ $building->id }}">
                    @if($editingId === $building->id)
                        <td>
                            <input type="text" wire:model.defer="editName" class="form-control">
                            @error('editName') <span class="text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td>
                            <input type="text" wire:model.defer="editAddress" class="form-control">
                            @error('editAddress') <span class="text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td>
                            <button wire:click="updateBuilding" class="btn btn-success btn-sm">Save</button>
                            <button wire:click="cancelEdit" class="btn btn-secondary btn-sm">Cancel</button>
                        </td>
                    @else
                        <td>{{ $building->name }}</td>
                        <td>{{ $building->address }}</td>
                        <td>
                            <button wire:click.prevent="edit({{ $building->id }})" class="btn btn-warning btn-sm">Edit</button>
                            <button wire:click.prevent="deleteBuilding({{ $building->id }})" class="btn btn-danger btn-sm" wire:confirm="Are you sure to delete this?">Delete</button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
