<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-PDUiPu3vDllMfrUHnurV430Qg8chPZTNhY8RUpq89lq22R3PzypXQifBpcpE1eoB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
 
    @livewireStyles


    <!-- Scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="sidebar sidebar-narrow-unfoldable border-end sidebar-dark">
        <div class="sidebar-header border-bottom">
          <div class="sidebar-brand"><i class="bi bi-house-door"></i></div>
        </div>
        <ul class="sidebar-nav">
          <li class="nav-title">Society pro</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('/notice-board') }}">
              <i class="nav-icon cil-speedometer" style="color:black">
                @if(Auth::user()->unreadNotifications->where('type','App\Notifications\AdminNotification')->count()!=0)
                <span class="badge bg-primary ms-auto"><i class="nav-icon bi bi-person-video3"></i></span>
                @else
                <i class="nav-icon bi bi-person-video3"></i>
                @endif
              </i> Notice Board <span class="badge bg-primary ms-auto">
                {{Auth::user()->unreadNotifications->where('type','App\Notifications\AdminNotification')->count()}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('/complaint-board') }}">
              <i class="nav-icon cil-speedometer" style="color:black">
                @if(Auth::user()->unreadNotifications->where('type','App\Notifications\ComplaintStatusUpdated')->count()!=0)
                <span class="badge bg-primary ms-auto"><i class="nav-icon bi bi-person-lines-fill"></i></span>
                @else
                <i class="nav-icon bi bi-person-lines-fill"></i>
                @endif</i> Complaint
                <span class="badge bg-primary ms-auto">
                {{Auth::user()->unreadNotifications->where('type','App\Notifications\ComplaintStatusUpdated')->count()}}
                </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="nav-icon cil-speedometer"></i> With badge
              <span class="badge bg-primary ms-auto">NEW</span>
            </a>
          </li>

          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a class="nav-link mt-auto" href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="nav-icon bi bi-box-arrow-left"></i>Log Out
            </a>
            </form>
          </li>
        </ul>
        
      </div>
        <div>
          
        </div>
      </div>
    @livewireScripts
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js" integrity="sha384-8QmUFX1sl4cMveCP2+H1tyZlShMi1LeZCJJxTZeXDxOwQexlDdRLQ3O9L78gwBbe" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
</body>
</html>