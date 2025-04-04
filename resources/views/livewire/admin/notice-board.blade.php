<div>
    <strong>Notice Board</strong>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if(Auth::user()->usertype === 'Admin')
        <form wire:submit.prevent="createNotice">
            <div class="form-group">
                <input type="text" class="form-control" wire:model="title" placeholder="Notice Title">
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <textarea class="form-control" wire:model="content" placeholder="Notice Content"></textarea>
                @error('content') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Post Notice</button>
        </form>
    @endif

    <h3 class="mt-4">Recent Notices</h3>
    <ul class="list-group">
        @foreach($notices as $notice)
            <li class="list-group-item">
                <strong>{{ $notice->title }}</strong>
                <p>{{ $notice->content }}</p>
                <small>Posted on: {{ $notice->created_at->format('d M Y') }}</small>
            </li>
        @endforeach
    </ul>
</div>
