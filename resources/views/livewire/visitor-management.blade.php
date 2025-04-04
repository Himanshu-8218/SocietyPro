<div>
    @if(auth()->user()->usertype == 'Security' || auth()->user()->usertype == 'Resident')
    <h2>Visitor Management</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="addVisitor">
        <input type="text" wire:model="name" placeholder="Visitor Name" required>
        <input type="text" wire:model="contact" placeholder="Contact Number" required>
        <input type="text" wire:model="purpose" placeholder="Purpose of Visit" required>
        <button type="submit" class="btn btn-secondary">Register Visitor</button>
    </form>
    @endif

    <h3>Visitor Logs</h3>
    @if($visitors->count()==0)
    <div class="alert alert-info">
        <h3>No Visitor Found</h3>
    </div>       
    @else
    <table class="table table-dark table-striped table-hover">
        <tr >
            <th >Name</th>
            <th>Contact</th>
            <th>Purpose</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach($visitors as $visitor)
            <tr>
                <td>{{ $visitor->name }}</td>
                <td>{{ $visitor->contact }}</td>
                <td>{{ $visitor->purpose }}</td>
                <td>{{ $visitor->status }}</td>
                <td>
                    @if($visitor->status == 'pending' && auth()->user()->usertype == 'Security')
                        <button wire:click="approveVisitor({{ $visitor->id }})" class="btn btn-danger">Approve</button>
                        <button wire:click="denyVisitor({{ $visitor->id }})" class="btn btn-secondary">Deny</button>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    @endif
</div>
