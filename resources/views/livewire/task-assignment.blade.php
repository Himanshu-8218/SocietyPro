<div class="container mt-4">
    <div class="card p-4 shadow-sm mb-5">
        <h4 class="mb-3">Assign Task to Maintenance Staff</h4>

        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <form wire:submit.prevent="assignTask">
            <div class="mb-3">
                <label for="staff_id" class="form-label">Select Staff</label>
                <select wire:model="staff_id" class="form-select" id="staff_id">
                    <option value="">-- Select --</option>
                    @foreach($maintenanceStaff as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                    @endforeach
                </select>
                @error('staff_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="task_description" class="form-label">Task Description</label>
                <textarea wire:model="task_description" id="task_description" class="form-control" rows="3"></textarea>
                @error('task_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Assign Task</button>
        </form>
    </div>

    {{-- TASK LIST SECTION --}}
    <div class="card p-4 shadow-sm">
        <h4 class="mb-3">Assigned Tasks</h4>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Username</th>
                    <th>Usertype</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->user->name ?? 'N/A' }}</td>
                        <td>{{ $task->user->usertype ?? 'N/A' }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            <span class="badge 
                                @if($task->status == 'pending') bg-warning
                                @elseif($task->status == 'completed') bg-success
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No tasks assigned yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
