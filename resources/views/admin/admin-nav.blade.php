<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-PDUiPu3vDllMfrUHnurV430Qg8chPZTNhY8RUpq89lq22R3PzypXQifBpcpE1eoB" crossorigin="anonymous">
    @livewireStyles


    <!-- Scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="sidebar sidebar-narrow-unfoldable border-end sidebar-dark">
        <div class="sidebar-header border-bottom">
          <div class="sidebar-brand">🏘️</div>
        </div>
        <ul class="sidebar-nav">
          <li class="nav-title">Society pro</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin/notice-board') }}">
              <i class="nav-icon cil-speedometer" style="color:black">📑</i> Notice Board
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin/staff-management') }}">
              <i class="nav-icon cil-speedometer" style="color:black">⚒️</i> Staff Managemnt
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="nav-icon cil-speedometer"></i> With badge
              <span class="badge bg-primary ms-auto">NEW</span>
            </a>
          </li>
          <li class="nav-item nav-group show">
            <a class="nav-link nav-group-toggle" href="#">
              <i class="nav-icon cil-puzzle">🧑‍💻</i> Register
            </a>
            <ul class="nav-group-items">
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin/create/staff')}}">
                  <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Staff
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin/create/security')}}">
                  <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Security
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a class="nav-link mt-auto" href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="nav-icon fa fa-sign-out"></i></i>Log Out
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
</body>
</html>