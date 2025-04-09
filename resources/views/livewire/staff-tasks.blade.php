<!-- resources/views/livewire/staff-tasks.blade.php -->

<div class="container mt-4">
    <div class="card p-4 shadow-sm">
        <h4 class="mb-3">My Assigned Tasks</h4>

        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        @if (count($tasks) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->description }}</td>
                            <td>
                                <span class="badge bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>
                                @if($task->status != 'completed')
                                <select wire:change="updateStatus({{ $task->id }}, $event.target.value)" class="form-select">
                                    @if($task->status != 'in_progress')
                                    <option value="pending" @if($task->status == 'pending') selected @endif>Pending</option>
                                    @endif
                                    <option value="in_progress" @if($task->status == 'in_progress') selected @endif>In Progress</option>
                                    <option value="completed" @if($task->status == 'completed') selected @endif>Completed</option>
                                </select>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No tasks assigned.</p>
        @endif
    </div>
</div>
