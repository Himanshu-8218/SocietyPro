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
  <title>SocietyPro | Admin</title>

    <!-- Scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body >
    <div class="sidebar sidebar-narrow-unfoldable border-end sidebar-dark">
        <div class="sidebar-header border-bottom">
          <div class="sidebar-brand"><i class="bi bi-house-door"></i></div>
        </div>
        <ul class="sidebar-nav">
          <li class="nav-title">Society pro</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin/dashboard') }}">
              <i class="nav-icon bi bi-speedometer2"></i>
               DashBoard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin/notice-board') }}">
              <i class="nav-icon bi bi-person-video3"></i> Notice Board
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin/staff-management') }}">
              <i class="nav-icon bi bi-person-gear"></i> Staff Section
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin/complaint-board') }}">
              <i class="nav-icon bi bi-person-lines-fill"></i> Complaint
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin/attendence') }}">
              <i class="nav-icon bi bi-ui-checks"></i> Attendence
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin/bill') }}">
              <i class="nav-icon bi bi-receipt"></i> Bill
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin/facility/view') }}">
              <i class="nav-icon bi bi-house-gear"></i> Facilities
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin/visitor') }}">
              <i class="nav-icon bi bi-people"></i> Visitor
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
          <li><a class="dropdown-item" href="{{ route('admin/profile') }}"><i class="bi bi-person-fill-up ms-4">  </i>Profile</a></li>
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