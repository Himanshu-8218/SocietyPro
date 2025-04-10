<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            @if(Auth::user()->usertype == 'Security' || Auth::user()->usertype == 'Staff')
                <strong class="card-title mb-5 fs-3">
                    Attendance Report of <strong class="fs-2">{{ Auth::user()->name }}</strong>
                </strong>
            @else
                <strong class="card-title mb-5 fs-3">
                    Attendance Report of <strong class="fs-3">Security and Staff</strong>
                </strong>
            @endif

            <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            @if(Auth::user()->usertype == 'Admin')
                                <th>Name</th>
                                <th>Usertype</th>
                            @endif
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                @if(Auth::user()->usertype == 'Admin')
                                    <td>{{ $users->firstWhere('id', $attendance->user_id)?->name ?? 'N/A' }}</td>
                                    <td>{{ $attendance->usertype }}</td>
                                @endif
                                <td>{{ ucfirst($attendance->status) }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
</div>
