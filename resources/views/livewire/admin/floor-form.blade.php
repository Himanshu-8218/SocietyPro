<div class="container mt-5">

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Floor Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white fw-bold">
            {{ $floor_id ? 'Edit Floor' : 'Add Floor' }}
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Building</label>
                        <select wire:model="building_id" class="form-select" required>
                            <option value="">Select Building</option>
                            @foreach($buildings as $building)
                                <option value="{{ $building->id }}">{{ $building->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Floor Number</label>
                        <input type="number" wire:model.defer="number" class="form-control" placeholder="Enter Floor Number" required>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">
                            {{ $floor_id ? 'Update' : 'Add' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Floor List Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white fw-bold">
            Floor List
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped m-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Building</th>
                            <th>Floor Number</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($floors as $floor)
                            <tr>
                                <td>{{ $floor->building->name }}</td>
                                <td>{{ $floor->number }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button wire:click="edit({{ $floor->id }})" class="btn btn-warning btn-sm">Edit</button>
                                        <button wire:click="delete({{ $floor->id }})" class="btn btn-danger btn-sm">Delete</button>
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
