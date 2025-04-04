<div>
    <strong>Staff List</strong>
    {{-- Flash messages --}}
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    
    {{-- Users List --}}

    <div class="container mt-3">
        @foreach ($users as $user)
        <div class="email-row">
            <h1 style="display:inline; color:white">{{ $user->email }}</h1>
            <div class="email-buttons">
                <button class="btn btn-danger" style="display:inline" wire:click="delete_staff({{ $user->id }})">Delete</button>
                <button class="btn btn-secondary" style="display:inline" >Edit</button>
            </div>
        </div>
        @endforeach

        {{-- Pagination Links  --}}
        {{-- <div class="mt-4">
            {{ $users->links() }}
        </div> --}}
    </div>
    
    
    <style>
        .email-row {
            display: flex; /* Creates a flexible row */
            justify-content: space-between; /* Pushes items to opposite ends of the row */
            align-items: center; /* Vertically centers the content */
            padding: 10px;
            margin-left: 20px;
            margin-right: 30px;
            margin-bottom: 5px;
            border-radius: 8px;
            background-color: #1F2937;
        }
    
        .email-buttons {
            display: flex; /* Groups the buttons in a row */
            gap: 20px; /* Adds space between the buttons */
        }
    </style>
</div>
