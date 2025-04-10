<div class="container">
    <div class="card p-4 shadow-sm">
        @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif
        <strong class="mb-4 fs-2">Mark Attendance</strong>

        <div class="mb-3">
            <label for="date" class="form-label">Select Date:</label>
            <input type="date" wire:model.lazy="date" id="date" class="form-control">
        </div>
        {{-- <div>{{$date}}</div> --}}

        <form wire:submit.prevent="markAttendance">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>UserType</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $userId => $attendance)
                    <tr wire:key="attendance-{{ $userId }}-{{ $attendance['status'] }}">
                        <td>{{ $attendance['name'] }}</td>
                        <td>{{ $attendance['usertype'] }}</td>
                        <td>
                            <select wire:key="select-{{ $userId }}" wire:model="attendances.{{ $userId }}.status" class="form-select">
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="on_leave">On Leave</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Save Attendance</button>
        </form>


    </div>

</div>