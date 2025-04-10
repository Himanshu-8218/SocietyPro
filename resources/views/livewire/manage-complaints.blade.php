<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold fs-3">Manage Complaints</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->description }}</td>
                    <td>
                        <span class="badge 
                            @if($complaint->status == 'Resolved') bg-success
                            @elseif($complaint->status == 'In Progress') bg-warning text-dark
                            @else bg-secondary @endif">
                            {{ $complaint->status }}
                        </span>
                    </td>
                    <td>
                        @if($complaint->status != "Resolved")
                        <select wire:model="status" class="form-select form-select-sm" wire:change="updateStatus({{ $complaint->id }})">
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Resolved">Resolved</option>
                        </select>
                        @else
                        <span class="text-muted">No Action Needed</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
