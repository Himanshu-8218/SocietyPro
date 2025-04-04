<div>
    <h2>All Notifications</h2>
    @foreach ($notifications as $notification)
        <h1>{{ $notification->data['message'] }}</h1>
    @endforeach

    <h2>Unread Notifications</h2>
    @if($unreads->count()==0)
        <div class="alert alert-info">
            <h3>No Unread Notification</h3>
        </div>       
    @endif
    @foreach ($unreads as $notification)
        <h1>{{ $notification->data['message'] }}</h1>
        <button class="btn btn-sm btn-success" wire:click="markAsRead('{{ $notification->id }}')">
            Mark as Read
        </button>
    @endforeach
</div>
