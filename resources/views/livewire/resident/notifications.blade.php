<div>
    <h2>Notifications</h2>

    <h4>Unread Notifications</h4>
    @if($unreadNotifications->count()==0)
        <div class="alert alert-info">
            <h3>No Unread Notice</h3>
        </div>       
    @endif
    @foreach ($unreadNotifications as $notification)
        <div class="alert alert-info">
            <strong>{{ $notification->data['title'] }}</strong>
            <p>{{ $notification->data['content'] }}</p>
            <button class="btn btn-sm btn-success" wire:click="markAsRead('{{ $notification->id }}')">Mark as Read</button>
        </div>
    @endforeach

    <h4>All Notifications</h4>
    @foreach ($allNotifications as $notification)
        <div class="alert alert-secondary">
            <strong>{{ $notification->data['title'] }}</strong>
            <p>{{ $notification->data['content'] }}</p>
        </div>
    @endforeach
</div>
