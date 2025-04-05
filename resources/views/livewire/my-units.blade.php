<div class="container">
    <h2>My Owned Units</h2>

    <table>
        <thead>
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
                    <td>{{ $unit->floor->number }}</td>
                    <td>{{ $unit->unit_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
