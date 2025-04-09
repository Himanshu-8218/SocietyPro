<div>
    <div class="container mt-5">
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
    
        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
    
    <!-- Edit Profile Container -->
    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-3">Edit Profile</h4>
                <form wire:submit.prevent="updateProfile">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" wire:model.defer="name" class="form-control" id="name">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" wire:model.defer="email" class="form-control" id="email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
    
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" wire:model.defer="contact" class="form-control" id="contact">
                        @error('contact') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
    
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Change Password Container -->
    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-3">Change Password</h4>
                <form wire:submit.prevent="changePassword">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" wire:model.defer="current_password" class="form-control" id="current_password">
                        @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
    
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" wire:model.defer="new_password" class="form-control" id="new_password">
                        @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
    
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" wire:model.defer="confirm_password" class="form-control" id="confirm_password">
                    </div>
    
                    <button type="submit" class="btn btn-warning">Change Password</button>
                </form>
            </div>
        </div>
    </div>
    
</div>
