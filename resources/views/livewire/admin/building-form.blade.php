<div class="container mt-5">

    <!-- Add Building Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white fw-bold">
            Add New Building
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-5">
                    <input type="text" wire:model.defer="newBuildingName" placeholder="Building Name" class="form-control" />
                </div>
                <div class="col-md-5">
                    <input type="text" wire:model.defer="newBuildingAddress" placeholder="Building Address" class="form-control" />
                </div>
                <div class="col-md-2">
                    <button wire:click="addBuilding" class="btn btn-primary w-100">Add Building</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Buildings Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white fw-bold">
            Buildings List
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered m-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th style="width: 160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buildings as $building)
                            <tr wire:key="building-{{ $building->id }}">
                                @if($editingId === $building->id)
                                    <td>
                                        <input type="text" wire:model.defer="editName" class="form-control" />
                                        @error('editName') <small class="text-danger">{{ $message }}</small> @enderror
                                    </td>
                                    <td>
                                        <input type="text" wire:model.defer="editAddress" class="form-control" />
                                        @error('editAddress') <small class="text-danger">{{ $message }}</small> @enderror
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button wire:click="updateBuilding" class="btn btn-success btn-sm">Save</button>
                                            <button wire:click="cancelEdit" class="btn btn-secondary btn-sm">Cancel</button>
                                        </div>
                                    </td>
                                @else
                                    <td>{{ $building->name }}</td>
                                    <td>{{ $building->address }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button wire:click.prevent="edit({{ $building->id }})" class="btn btn-warning btn-sm">Edit</button>
                                            <button wire:click.prevent="deleteBuilding({{ $building->id }})" class="btn btn-danger btn-sm">Delete</button>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
