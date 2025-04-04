<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submitComplaint">
        <div class="form-group">
            <label for="description">Complaint Description</label>
            <textarea wire:model="description" id="description" class="form-control" rows="4" required></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit Complaint</button>
    </form>
</div>