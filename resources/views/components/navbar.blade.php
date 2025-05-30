<!-- resources/views/components/navbar.blade.php -->
<nav class="navbar navbar-expand-lg fixed-top py-2"
  style="background-color: rgba(15, 15, 15, 0.85); backdrop-filter: blur(10px);">
  <div class="container-fluid">
    <!-- Brand with logo on left -->
    <div class="d-flex align-items-center">
      <a class="navbar-brand d-flex align-items-center me-3"
        href="{{auth()->user() ? route('dashboard') : route('home')}}" style="color: #00F6FF;">
        <!-- Larger Logo -->
        <img src="{{ asset('images/Untitled_design.svg') }}" alt="RHYTMX Logo"
          style="height: 50px; width: auto; min-width: 50px;" class="d-inline-block align-middle">
        <!-- Brand Text -->
        <span class="fw-bold ms-2" style="color: #8F00FF; font-size: 1.5rem;">RHYTMX</span>
      </a>
    </div>

    <!-- Mobile toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <!-- Centered navigation -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Route::is('home') ? 'active' : '' }}"
            href="{{auth()->user() ? route('dashboard') : route('home')}}" style="color: #00F6FF;">
            <i class="bi bi-house-door me-1"></i> Home
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Route::is('events.browse') ? 'active' : '' }}" href="{{ route('events.browse') }}"
            style="color: #00F6FF;">
            <i class="bi bi-calendar3 me-1"></i> Browse Events
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Route::is('pricing') ? 'active' : '' }}" href="{{ route('pricing') }}"
            style="color: #00F6FF;">
            <i class="bi bi-tags me-1"></i> Pricing
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}"
            style="color: #00F6FF;">
            <i class="bi bi-info-circle me-1"></i> About
          </a>
        </li>
      </ul>

      <!-- Right-aligned items -->
      <div class="d-flex">
        <!-- Search bar -->
        <form class="d-flex me-3" role="search">
          <div class="input-group">
            <input class="form-control" type="search" placeholder="Search events..." aria-label="Search"
              style="background-color: rgba(255,255,255,0.1); color: white; border-color: #8F00FF;">
            <button class="btn" type="submit" style="background-color: #8F00FF; color: white;">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>

        <ul class="navbar-nav">
          @auth
        <!-- Cart icon moved to right side -->
        <li class="nav-item me-2">
        <a class="nav-link position-relative {{ Route::is('cart.view') ? 'active' : '' }}"
          href="{{ route('cart.view') }}" style="color: #00F6FF;">
          <i class="bi bi-cart3 fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
          style="background-color: #8F00FF; color: white;">
          3
          <span class="visually-hidden">items in cart</span>
          </span>
        </a>
        </li>

        <!-- Notifications dropdown -->
        <li class="nav-item dropdown me-2">
        <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button"
          data-bs-toggle="dropdown" style="color: #00F6FF;">
          <i class="bi bi-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
          style="background-color: #00F6FF; color: black;">
          5
          <span class="visually-hidden">unread notifications</span>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end p-2"
          style="width: 300px; background-color: rgba(15, 15, 15, 0.95);">
          <li class="dropdown-header" style="color: #8F00FF;">Notifications</li>
          <li><a class="dropdown-item" href="#" style="color: #00F6FF;">New event in your area</a></li>
          <li><a class="dropdown-item" href="#" style="color: #00F6FF;">Your ticket confirmed</a></li>
          <li>
          <hr class="dropdown-divider" style="border-color: #333;">
          </li>
          <li><a class="dropdown-item text-center" href="#" style="color: #00F6FF;">View all notifications</a></li>
        </ul>
        </li>

        <!-- User dropdown -->
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
          data-bs-toggle="dropdown" style="color: #00F6FF;">
          <img src="https://via.placeholder.com/30" alt="User profile" class="rounded-circle me-2" width="30"
          height="30">
          {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" style="background-color: rgba(15, 15, 15, 0.95);">
          <li><a class="dropdown-item" href="#" style="color: #00F6FF;"><i class="bi bi-person me-2"></i>
            Profile</a></li>
          <li><a class="dropdown-item" href="#" style="color: #00F6FF;"><i class="bi bi-gear me-2"></i> Settings</a>
          </li>
          <li>
          <hr class="dropdown-divider" style="border-color: #333;">
          </li>
          <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item" style="color: #00F6FF;"><i
              class="bi bi-box-arrow-right me-2"></i> Logout</button>
          </form>
          </li>
        </ul>
        </li>
      @else
        <!-- Guest user options -->
        <li class="nav-item">
        <a class="nav-link {{ Route::is('login') ? 'active' : '' }}" href="{{ route('login') }}"
          style="color: #00F6FF;">
          <i class="bi bi-box-arrow-in-right me-1"></i> Login
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ Route::is('register') ? 'active' : '' }}" href="{{ route('register') }}"
          style="color: #00F6FF;">
          <i class="bi bi-person-plus me-1"></i> Register
        </a>
        </li>
      @endauth

          <!-- Dark/light mode toggle -->
          <li class="nav-item ms-2">
            <button class="btn btn-link nav-link" id="themeToggle" style="color: #00F6FF;">
              <i class="bi bi-moon-fill d-none"></i>
              <i class="bi bi-sun-fill d-none"></i>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<style>
  /* Hover Effects */
  .nav-link:hover {
    color: #8F00FF !important;
    text-shadow: 0 0 8px rgba(143, 0, 255, 0.5);
  }

  .dropdown-item:hover {
    background-color: rgba(143, 0, 255, 0.2) !important;
  }

  .navbar-brand:hover span {
    color: #00F6FF !important;
    text-shadow: 0 0 8px rgba(0, 246, 255, 0.5);
  }

  /* Active State */
  .nav-link.active {
    color: white !important;
    font-weight: bold;
  }

  /* Mobile Responsiveness */
  @media (max-width: 992px) {
    .navbar-brand span {
      font-size: 1.3rem !important;
    }

    .navbar {
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;
    }
  }
</style>

@push('scripts')
  <script>
    // Theme toggle functionality
    document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('themeToggle');
    const moonIcon = themeToggle.querySelector('.bi-moon-fill');
    const sunIcon = themeToggle.querySelector('.bi-sun-fill');

    // Check for saved theme preference or use preferred color scheme
    const currentTheme = localStorage.getItem('theme') ||
      (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

    // Apply the current theme
    if (currentTheme === 'dark') {
      document.documentElement.setAttribute('data-bs-theme', 'dark');
      moonIcon.classList.add('d-none');
      sunIcon.classList.remove('d-none');
    } else {
      document.documentElement.setAttribute('data-bs-theme', 'light');
      sunIcon.classList.add('d-none');
      moonIcon.classList.remove('d-none');
    }

    // Toggle theme on button click
    themeToggle.addEventListener('click', function () {
      if (document.documentElement.getAttribute('data-bs-theme') === 'dark') {
      document.documentElement.setAttribute('data-bs-theme', 'light');
      localStorage.setItem('theme', 'light');
      sunIcon.classList.add('d-none');
      moonIcon.classList.remove('d-none');
      } else {
      document.documentElement.setAttribute('data-bs-theme', 'dark');
      localStorage.setItem('theme', 'dark');
      moonIcon.classList.add('d-none');
      sunIcon.classList.remove('d-none');
      }
    });

    // Highlight active dropdown items
    document.querySelectorAll('.dropdown-item').forEach(item => {
      if (item.href === window.location.href) {
      item.classList.add('active');
      }
    });
    });
  </script>
@endpush