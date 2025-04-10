<div class="container mt-5">

    <!-- Card Container -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">
            Notice Board
        </div>

        <div class="card-body">
            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Admin Form -->
            @if(Auth::user()->usertype === 'Admin')
                <form wire:submit.prevent="createNotice" class="mb-4">
                    <div class="mb-3">
                        <label class="form-label">Notice Title</label>
                        <input type="text" class="form-control" wire:model="title" placeholder="Enter title">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notice Content</label>
                        <textarea class="form-control" wire:model="content" rows="4" placeholder="Enter content"></textarea>
                        @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Post Notice</button>
                </form>
            @endif
        </div>
    </div>

    <!-- Recent Notices -->
    <h4 class="mt-5 mb-3">Recent Notices</h4>

    @if ($notices->count())
        <ul class="list-group">
            @foreach($notices as $notice)
                <li class="list-group-item mb-2 shadow-sm">
                    <h5 class="fw-bold">{{ $notice->title }}</h5>
                    <p class="mb-1">{{ $notice->content }}</p>
                    <small class="text-muted">Posted on: {{ $notice->created_at->format('d M Y') }}</small>
                </li>
            @endforeach
        </ul>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $notices->links() }}
        </div>
    @else
        <div class="alert alert-info mt-4">No notices available.</div>
    @endif

</div>
