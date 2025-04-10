<div class="container mt-5">

    <!-- Visitor Management Title -->
    @if(auth()->user()->usertype == 'Security' || auth()->user()->usertype == 'Resident')
        <div class="mb-4">
            <strong class="fw-bold fs-2">Visitor Management</strong>

            <!-- Session Message -->
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Visitor Registration Form -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white fw-semibold">Register Visitor</div>
                <div class="card-body">
                    <form wire:submit.prevent="addVisitor">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <input type="text" wire:model="name" class="form-control" placeholder="Visitor Name" required>
                            </div>
                            <div class="col-md-3">
                                <input type="text" wire:model="contact" class="form-control" placeholder="Contact Number" required>
                            </div>
                            <div class="col-md-3">
                                <input type="text" wire:model="purpose" class="form-control" placeholder="Purpose of Visit" required>
                            </div>
                            <div class="col-md-2">
                                <input type="date" wire:model="date" class="form-control" required>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success w-80">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Visitor Logs -->
    <atrong class="mt-5 mb-3 fs-3">Visitor Logs</atrong>

    @if($visitors->count() == 0)
        <div class="alert alert-info">
            <strong>No visitors found.</strong>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->name }}</td>
                            <td>{{ $visitor->contact }}</td>
                            <td>{{ $visitor->purpose }}</td>
                            <td>
                                <span class="badge 
                                    @if($visitor->status == 'approved') bg-success
                                    @elseif($visitor->status == 'denied') bg-danger
                                    @else bg-warning text-dark @endif">
                                    {{ ucfirst($visitor->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($visitor->date)->format('d M Y') }}</td>
                            <td class="text-center">
                                @if($visitor->status == 'pending' && auth()->user()->usertype == 'Security')
                                    <div class="d-flex justify-content-center gap-2">
                                        <button wire:click="approveVisitor({{ $visitor->id }})" class="btn btn-sm btn-success">Approve</button>
                                        <button wire:click="denyVisitor({{ $visitor->id }})" class="btn btn-sm btn-danger">Deny</button>
                                    </div>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
