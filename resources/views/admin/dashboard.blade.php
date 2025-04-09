@include('admin.admin-nav')
<div style="width: 87%; margin-left: 7%; margin-top: 3rem;">
    <div class="flex">
        <div class="container">
            <strong><h1 class="text-center mb-4">Add & View Property</h1></strong>
            <div class="row justify-content-center">
                <!-- Buildings Card -->
                <div class="col-md-4" >
                    <a href="{{ route('admin/buildings') }}" class="text-decoration-none">
                        <div class="card mb-3 shadow-sm">
                            <div class="row g-0 align-items-center" style="background-color: #3d4557;border-radius: 4px;">
                                <div class="col-4 text-center" >
                                    <i class="bi bi-building fs-1 text-danger"></i>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title text-danger">Buildings</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Floors Card -->
                <div class="col-md-4">
                    <a href="{{ route('admin/floors') }}" class="text-decoration-none">
                        <div class="card mb-3 shadow-sm">
                            <div class="row g-0 align-items-center" style="background-color: #3d4557;border-radius: 4px;">
                                <div class="col-4 text-center">
                                    <i class="bi bi-layers fs-1 text-success"></i>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title text-success">Floors</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Units Card -->
                <div class="col-md-4">
                    <a href="{{ route('admin/units') }}" class="text-decoration-none">
                        <div class="card mb-3 shadow-sm">
                            <div class="row g-0 align-items-center" style="background-color: #3d4557;border-radius: 4px;">
                                <div class="col-4 text-center">
                                    <i class="bi bi-house fs-1 text-warning"></i>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title text-warning">Units</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        
        
    </div>
    <livewire:financial-reports/>
    <br/>
    <livewire:admin.billing-manager/>
    <br/>
    <livewire:admin.staff-schedule/>
    <br/>
    <livewire:task-assignment/>
    <br/>
    <livewire:attendance-manager/>
    <br/>
    <livewire:attendance-report/>
    <br/>
    <livewire:profile-management/>
</div>