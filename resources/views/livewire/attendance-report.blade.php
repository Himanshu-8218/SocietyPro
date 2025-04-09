<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            @if(Auth::user()->usertype == 'Security' || Auth::user()->usertype == 'Staff')
                <h3 class="card-title mb-3">
                    Attendance Report of <strong>{{ Auth::user()->name }}</strong>
                </h3>
            @else
                <h3 class="card-title mb-3">
                    Attendance Report of <strong>Security and Staff</strong>
                </h3>
            @endif

            <div class="table-responsive">
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
