<div class="container mt-5">
    {{-- Registration Cards --}}
    <div class="d-flex justify-content-center gap-4 mb-5">

        {{-- Register Staff Card --}}
        <a href="{{route('admin/create/staff')}}" class="text-decoration-none">
            <div class="card shadow-sm p-3 text-center" style="width: 200px;">
                <i class="bi bi-person-badge" style="font-size: 2rem; color: #0d6efd;"></i>
                <h5 class="mt-2">Register Staff</h5>
            </div>
        </a>

        {{-- Register Security Card --}}
        <a href="{{route('admin/create/security')}}" class="text-decoration-none">
            <div class="card shadow-sm p-3 text-center" style="width: 200px;">
                <i class="bi bi-shield-lock" style="font-size: 2rem; color: #198754;"></i>
                <h5 class="mt-2">Register Security</h5>
            </div>
        </a>

    </div>
    <div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <strong><h1 class="mb-4">Staff Management</h1></strong>

    <table class="table table-bordered table-striped align-middle table-hover">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th style="width: 220px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr wire:key="user-{{ $user->id }}">
                @if ($editUserId === $user->id)
                    <td><input type="text" class="form-control" wire:model.defer="name"></td>
                    <td><input type="email" class="form-control" wire:model.defer="email"></td>
                    <td>{{ $user->usertype }}</td>
                    <td>
                        <button class="btn btn-success btn-sm me-2" wire:click="update">Save</button>
                        <button class="btn btn-secondary btn-sm" wire:click="cancelEdit">Cancel</button>
                    </td>
                @else
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->usertype }}</td>
                    <td>
                        <div class="btn-group" wire:ignore.self>
                            <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" wire:click.prevent="edit({{ $user->id }})">Edit</a></li>
                                <li><a class="dropdown-item text-danger" href="#" wire:click.prevent="delete_staff({{ $user->id }})">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                @endif
            </tr>
            
            @endforeach
        </tbody>
    </table>

</div>

</div>
