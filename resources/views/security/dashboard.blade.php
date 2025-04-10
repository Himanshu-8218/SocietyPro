@include("security.security-nav")

<div style="width: 87%; margin-left: 7%; margin-top: 3rem;">
    <div class="row justify-content-center mb-4">

        <!-- Present Card -->
        <div class="col-md-4 mb-3">
            <a href="{{ route('security/activity') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-clipboard-check fs-1 text-success mb-2"></i>
                        <h5 class="card-title">Present</h5>
                        <p class="card-text fs-4">
                            {{ \App\Models\Attendance::where('user_id', Auth::id())->where('status', 'present')->count() }}
                            /
                            {{ \App\Models\Attendance::where('user_id', Auth::id())->count() }}
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <!-- On Leave Card -->
        <div class="col-md-4 mb-3">
            <a href="{{ route('security/activity') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-umbrella fs-1 text-primary mb-2"></i>
                        <h5 class="card-title">On Leave</h5>
                        <p class="card-text fs-4">
                            {{ \App\Models\Attendance::where('user_id', Auth::id())->where('status', 'on_leave')->count() }}
                            /
                            {{ \App\Models\Attendance::where('user_id', Auth::id())->count() }}
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Absent Card -->
        <div class="col-md-4 mb-3">
            <a href="{{ route('security/activity') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-x-circle fs-1 text-danger mb-2"></i>
                        <h5 class="card-title">Absent</h5>
                        <p class="card-text fs-4">
                            {{ \App\Models\Attendance::where('user_id', Auth::id())->where('status', 'absent')->count() }}
                            /
                            {{ \App\Models\Attendance::where('user_id', Auth::id())->count() }}
                        </p>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <livewire:visitor-management />
</div>
