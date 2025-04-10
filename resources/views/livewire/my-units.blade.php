<div class="container mt-5">
    <h2 class="fw-semibold mb-4">My Owned Units</h2>

    <!-- Units Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Building</th>
                    <th>Address</th>
                    <th>Floor</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($units as $unit)
                    <tr>
                        <td>{{ $unit->floor->building->name }}</td>
                        <td>{{ $unit->floor->building->address }}</td>
                        <td>Floor {{ $unit->floor->number }}</td>
                        <td>{{ $unit->unit_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
