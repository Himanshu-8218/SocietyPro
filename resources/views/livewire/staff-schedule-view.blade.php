<div class="container mt-5">
    <h4 class="mb-4">My Shift Schedule</h4>

    @if($shifts->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Shift</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shifts as $shift)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($shift->date)->format('d M Y') }}</td>
                        <td>{{ $shift->shift }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $shifts->links() }}
    @else
        <div class="alert alert-info">No shifts assigned yet.</div>
    @endif
</div>
