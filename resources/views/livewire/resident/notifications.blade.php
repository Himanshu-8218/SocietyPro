<div class="container mt-5">

    <!-- Header -->
    <div class="mb-4">
        <h1 class="fw-bold">Notifications</h1>
    </div>

    <!-- Unread Notifications -->
    <div class="mb-5">
        <h4 class="mb-3 text-primary">Unread Notifications</h4>

        @if($unreadNotifications->count() == 0)
            <div class="alert alert-info">
                <strong>No unread notifications.</strong>
            </div>
        @else
            @foreach ($unreadNotifications as $notification)
                <div class="alert alert-warning d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $notification->data['title'] }}</h5>
                        <p class="mb-2">{{ $notification->data['content'] }}</p>
                        <small class="text-muted">Received: {{ $notification->created_at->format('d M Y h:i A') }}</small>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-success" wire:click="markAsRead('{{ $notification->id }}')">
                            Mark as Read
                        </button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- All Notifications -->
    <div>
        <h4 class="mb-3 text-secondary">All Notifications</h4>

        @forelse ($allNotifications as $notification)
            <div class="alert alert-secondary">
                <h5 class="fw-bold mb-1">{{ $notification->data['title'] }}</h5>
                <p class="mb-2">{{ $notification->data['content'] }}</p>
                <small class="text-muted">Received: {{ $notification->created_at->format('d M Y h:i A') }}</small>
            </div>
        @empty
            <div class="alert alert-light">No notifications found.</div>
        @endforelse

        
    </div>

</div>
