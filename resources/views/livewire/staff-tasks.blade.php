<!-- resources/views/livewire/staff-tasks.blade.php -->

<div class="container mt-4">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold text-primary fs-4">My Assigned Tasks</h2>

        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Task Table -->
        @if (count($tasks) > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Change Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Description -->
                                <td>{{ $task->description }}</td>

                                <!-- Status Badge -->
                                <td>
                                    <span class="badge 
                                        @if($task->status === 'completed') bg-success
                                        @elseif($task->status === 'in_progress') bg-warning text-dark
                                        @else bg-secondary @endif">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>

                                <!-- Status Dropdown -->
                                <td>
                                    @if($task->status != 'completed')
                                        <select 
                                            wire:change="updateStatus({{ $task->id }}, $event.target.value)" 
                                            class="form-select form-select-sm">
                                            @if($task->status != 'in_progress')
                                                <option value="pending" @selected($task->status == 'pending')>Pending</option>
                                            @endif
                                            <option value="in_progress" @selected($task->status == 'in_progress')>In Progress</option>
                                            <option value="completed" @selected($task->status == 'completed')>Completed</option>
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
        @else
            <div class="alert alert-info">No tasks assigned.</div>
        @endif
    </div>
</div>
