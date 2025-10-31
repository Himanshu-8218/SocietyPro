<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.bunny.net">
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-PDUiPu3vDllMfrUHnurV430Qg8chPZTNhY8RUpq89lq22R3PzypXQifBpcpE1eoB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href=""><i class="bi bi-building-fill-up"></i></link>
    @livewireStyles
  <title>SocietyPro | Resident</title>

    <!-- Scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media (min-width: 992px) {
      .sidebar-narrow,
      .sidebar-narrow-unfoldable:not(:hover) {
        flex: 0 0 var(--cui-sidebar-narrow-width);
        width: var(--cui-sidebar-narrow-width);
        padding-bottom: var(--cui-sidebar-toggler-height);
        overflow: visible;
      }
    
      .sidebar-narrow .sidebar-header,
      .sidebar-narrow-unfoldable:not(:hover) .sidebar-header {
        justify-content: center;
        padding-right: 0;
        padding-left: 0;
      }
    }
    
    /* Mobile: override CoreUI's sidebar hide logic */
    @media (max-width: 991.98px) {
      .sidebar {
        margin-inline-start: 0 !important;
        width: var(--cui-sidebar-narrow-width) !important;
        flex: 0 0 var(--cui-sidebar-narrow-width) !important;
      }
    
      .sidebar .sidebar-header {
        justify-content: center;
        padding-left: 0;
        padding-right: 0;
      }
    
      .sidebar .nav-link {
        text-align: center;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
      }
    
      .sidebar .nav-icon {
        margin-right: 1.17rem;
      }
    
      .sidebar .nav-title {
        display: none; /* Optional: hide nav titles on small screen */
     } 
      
     .sidebar-narrow .nav-link, .sidebar-narrow-unfoldable:not(:hover) .nav-link {
            overflow: hidden;
        }
      
    }
        </style>
</head>
<body >
  <button class="btn btn-primary d-lg-none" type="button" data-coreui-toggle="sidebar">
    <i class="cil-menu"></i>
  </button>
    <div class="sidebar sidebar-narrow-unfoldable border-end sidebar-dark">
        <div class="sidebar-header border-bottom">
          <div class="sidebar-brand"><i class="bi bi-house-door"></i></div>
        </div>
        <ul class="sidebar-nav">
          <li class="nav-title">Society pro</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="nav-icon bi bi-speedometer2"></i>
               DashBoard
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
            <a class="nav-link" href="{{ route('resident/bill') }}">
              <i class="nav-icon bi bi-receipt"></i> Bill
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('resident/facility') }}">
              <i class="nav-icon bi bi-house-gear"></i> Facilities
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('resident/visitor') }}">
              <i class="nav-icon bi bi-people"></i> Visitor
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('ocr.form') }}">
              <i class="nav-icon bi bi-file-earmark-text"></i> OCR Extractor
            </a>
          </li>
        </ul>
      </div>
      <div>
      <div class="dropdown-center">
        <button class="btn btn-secondary dropdown-toggle position-absolute top-0 end-0" style="margin-right: 2rem" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle">  </i>  {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('resident/profile') }}"><i class="bi bi-person-fill-up ms-4">  </i>Profile</a></li>
          <li class="dropdown-item"><form method="POST" action="{{ route('logout') }}">
            @csrf

            <a href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                <i class="bi bi-box-arrow-left ms-4">  </i>Log Out
            </a>
        </form>
      </li>
        </ul>
      </div>

          
        </div>
      </div>
    @livewireScripts
    {{-- <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script> --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js" integrity="sha384-8QmUFX1sl4cMveCP2+H1tyZlShMi1LeZCJJxTZeXDxOwQexlDdRLQ3O9L78gwBbe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>