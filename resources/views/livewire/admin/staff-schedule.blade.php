<div class="card container mt-5">
    <h4 class="fs-1 mt-2">Assign Shift to Staff</h4>
    @if (session()->has('messagestaff'))
        <div class="alert alert-success">{{ session('messagestaff') }}</div>
    @endif
    <br/>
    <div class="row">
        <div class="col-md-3">
            <label>Staff</label>
            <select class="form-control" wire:model="selected_staff">
                <option value="">Select</option>
                @foreach($staff as $person)
                    <option value="{{ $person->id }}">{{ $person->name }}-{{$person->usertype}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Shift</label>
            <select class="form-control" wire:model="shift_type">
                <option value="">Select</option>
                <option value="6am - 2pm">6am - 2pm</option>
                <option value="2pm - 10pm">2pm - 10pm</option>
                <option value="10pm - 6am">10pm - 6am</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>Date</label>
            <input type="date" class="form-control" wire:model.defer="shift_date">
        </div>
        <div class="col-md-3 mt-4">
            <button class="btn btn-primary" wire:click="assignShift">Assign Shift</button>
        </div>
    </div>

    <hr class="my-3">

<h5 class="mb-3 fs-3">Scheduled Staff Shifts</h5>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Staff</th>
            <th>User Type</th>
            <th>Date</th>
            <th>Shift</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($schedules as $schedule)
            <tr>
                <td>{{ $schedule->user->name }}</td>
                <td>{{ $schedule->user->usertype }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</td>
                <td>{{ $schedule->shift }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No shifts assigned yet.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $schedules->links() }}

</div>
