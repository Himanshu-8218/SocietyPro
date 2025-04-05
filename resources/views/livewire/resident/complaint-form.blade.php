<div>
    <strong><h1>All Notifications</h1></strong>
    <br/>
    @if($notifications->count()==0)
    <div class="alert alert-info">
        <h3>No Notification</h3>
    </div>       
    @endif
    @foreach ($notifications as $notification)
    <div class="alert alert-secondary">
        {{-- <strong>{{ $notification->data['title'] }}</strong> --}}
        <strong>{{ $notification->data['message'] }}</strong>
    </div>
    @endforeach
    <br/>
    <strong><h1>Unread Notifications</h1></strong>
    <br/>
    @if($unreads->count()==0)
        <div class="alert alert-info">
            <h3>No Unread Notification</h3>
        </div>       
    @endif
    @foreach ($unreads as $notification)
    <div class="alert alert-secondary">
        {{-- <strong>{{ $notification->data['title'] }}</strong> --}}
        <strong>{{ $notification->data['message'] }}</strong>
        <br/>
        <button class="btn btn-sm btn-success" wire:click="markAsRead('{{ $notification->id }}')">
            Mark as Read
        </button>
    </div>
    @endforeach
</div>
