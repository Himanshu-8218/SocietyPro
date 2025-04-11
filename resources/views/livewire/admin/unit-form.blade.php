<div class="container mt-5">
    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Add Unit Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white fw-bold">
            Add New Unit
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">Floor</label>
                        <select wire:model.defer="floor_id" class="form-select" required>
                            <option value="">Select Floor</option>
                            @foreach($floors as $floor)
                                <option value="{{ $floor->id }}">{{ $floor->building->name }} - Floor {{ $floor->number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Unit Number</label>
                        <input type="text" wire:model.defer="unit_number" class="form-control" placeholder="e.g. 101" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select wire:model="status" class="form-select">
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">{{ $unit_id ? 'Update' : 'Add' }} Unit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Unit List with Inline Editing -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white fw-bold">
            Unit List
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered m-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Building</th>
                            <th>Floor</th>
                            <th>Unit</th>
                            <th>Status</th>
                            <th style="width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($units as $unit)
                            <tr>
                                @if($edit_id === $unit->id)
                                    <td>
                                        <select wire:model="edit_floor_id" class="form-select">
                                            <option value="">Select Floor</option>
                                            @foreach($floors as $floor)
                                                <option value="{{ $floor->id }}">{{ $floor->building->name }} - Floor {{ $floor->number }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td colspan="1">
                                        <input type="text" wire:model="edit_unit_number" class="form-control">
                                    </td>
                                    <td colspan="1">
                                        <span class="badge {{ $unit->status == 'available' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($unit->status) }}
                                        </span>
                                    </td>
                                    <td colspan="1">
                                        <button wire:click="update" class="btn btn-success btn-sm">Save</button>
                                        <button wire:click="cancelEdit" class="btn btn-secondary btn-sm">Cancel</button>
                                    </td>
                                @else
                                    <td>{{ $unit->floor->building->name }}</td>
                                    <td>{{ $unit->floor->number }}</td>
                                    <td>{{ $unit->unit_number }}</td>
                                    <td>
                                        <span class="badge {{ $unit->status == 'available' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($unit->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button wire:click="edit({{ $unit->id }})" class="btn btn-warning btn-sm">Edit</button>
                                            <button wire:click="delete({{ $unit->id }})" class="btn btn-danger btn-sm">Delete</button>
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
