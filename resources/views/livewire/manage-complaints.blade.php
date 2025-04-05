
<div>
    <strong><h1>Manage Complaints</h1></strong>
    <br/>
    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $complaint)
            <tr>
                <td>{{ $complaint->description }}</td>
                <td>{{ $complaint->status }}</td>
                <td>
                    @if($complaint->status!="Resolved")
                    <select wire:model="status" class="form-control" wire:change="updateStatus({{ $complaint->id }})">
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Resolved">Resolved</option>
                    </select>
                    @endif
                        
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>