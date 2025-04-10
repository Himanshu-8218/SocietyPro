<div class="container mt-5">

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Unit Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white fw-bold">
            {{ $unit_id ? 'Edit Unit' : 'Add New Unit' }}
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row g-3 align-items-end">
                    <!-- Floor Select -->
                    <div class="col-md-5">
                        <label class="form-label">Floor</label>
                        <select wire:model.defer="floor_id" class="form-select" required>
                            <option value="">Select Floor</option>
                            @foreach($floors as $floor)
                                <option value="{{ $floor->id }}">
                                    {{ $floor->building->name }} - Floor {{ $floor->number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Unit Number -->
                    <div class="col-md-3">
                        <label class="form-label">Unit Number</label>
                        <input type="text" wire:model.defer="unit_number" class="form-control" placeholder="e.g. 101" required>
                    </div>

                    <!-- Status -->
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select wire:model="status" class="form-select">
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">
                            {{ $unit_id ? 'Update' : 'Add' }} Unit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Units Table -->
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
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($units as $unit)
                            <tr>
                                <td>{{ $unit->floor->building->name }}</td>
                                <td>{{ $unit->floor->number }}</td>
                                <td>{{ $unit->unit_number }}</td>
                                <td>
                                    <span class="badge 
                                        @if($unit->status == 'available') bg-success
                                        @else bg-danger @endif">
                                        {{ ucfirst($unit->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button wire:click="edit({{ $unit->id }})" class="btn btn-warning btn-sm">Edit</button>
                                        <button wire:click="delete({{ $unit->id }})" class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
