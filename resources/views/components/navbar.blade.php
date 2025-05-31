<!-- resources/views/components/navbar.blade.php -->
<nav class="navbar navbar-expand-lg fixed-top py-2"
  style="background-color: rgba(15, 15, 15, 0.85); backdrop-filter: blur(10px);">
  <div class="container-fluid">
    <!-- Brand with logo -->
    <div class="d-flex align-items-center">
      <a class="navbar-brand d-flex align-items-center me-3"
        href="{{ auth()->user() ? route('dashboard') : route('home') }}" style="color: #00F6FF;">
        <img src="{{ asset('images/Untitled_design.svg') }}" alt="RHYTMX Logo" class="navbar-logo">
        <span class="fw-bold ms-2 brand-text">RHYTMX</span>
      </a>
    </div>

    <!-- Mobile toggle button with better accessibility -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <!-- Centered navigation -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Route::is('home') ? 'active' : '' }}"
            href="{{ auth()->user() ? route('dashboard') : route('home') }}">
            <i class="bi bi-house-door me-1"></i> Home
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Route::is('events.browse') ? 'active' : '' }}" href="{{ route('events.browse') }}">
            <i class="bi bi-calendar3 me-1"></i> Browse Events
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Route::is('pricing') ? 'active' : '' }}" href="{{ route('pricing') }}">
            <i class="bi bi-tags me-1"></i> Pricing
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">
            <i class="bi bi-info-circle me-1"></i> About
          </a>
        </li>
      </ul>

      <!-- Right-aligned items -->
      <div class="d-flex align-items-center">
        <!-- Search bar - collapses on mobile -->
        <form class="d-flex me-3 search-form" role="search">
          <div class="input-group">
            <input class="form-control search-input" type="search" placeholder="Search events..." aria-label="Search">
            <button class="btn search-btn" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>

        <ul class="navbar-nav">
          @auth
        <!-- Cart icon -->
        <li class="nav-item me-2">
        <a class="nav-link position-relative {{ Route::is('cart.view') ? 'active' : '' }}"
          href="{{ route('cart.view') }}">
          <i class="bi bi-cart3 fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-badge">
          3
          <span class="visually-hidden">items in cart</span>
          </span>
        </a>
        </li>

        <!-- Notifications dropdown -->
        <li class="nav-item dropdown me-2">
        <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill notification-badge">
          5
          <span class="visually-hidden">unread notifications</span>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end p-2 notification-dropdown"
          aria-labelledby="notificationsDropdown">
          <li class="dropdown-header">Notifications</li>
          <li><a class="dropdown-item" href="#">New event in your area</a></li>
          <li><a class="dropdown-item" href="#">Your ticket confirmed</a></li>
          <li>
          <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
        </ul>
        </li>

        <!-- User dropdown -->
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://via.placeholder.com/30" alt="" class="rounded-circle me-2 user-avatar">
          {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end user-dropdown" aria-labelledby="userDropdown">
          <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
          <li>
          <hr class="dropdown-divider">
          </li>
          <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
          </form>
          </li>
        </ul>
        </li>
      @else
        <!-- Guest user options -->
        <li class="nav-item">
        <a class="nav-link {{ Route::is('login') ? 'active' : '' }}" href="{{ route('login') }}">
          <i class="bi bi-box-arrow-in-right me-1"></i> Login
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ Route::is('register') ? 'active' : '' }}" href="{{ route('register') }}">
          <i class="bi bi-person-plus me-1"></i> Register
        </a>
        </li>
      @endauth

          <!-- Dark/light mode toggle -->
          <li class="nav-item ms-2">
            <button class="btn btn-link nav-link theme-toggle" id="themeToggle" aria-label="Toggle theme">
              <i class="bi bi-moon-fill theme-icon-dark"></i>
              <i class="bi bi-sun-fill theme-icon-light"></i>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<style>
  /* Base Styles */
  .navbar {
    transition: all 0.3s ease;
    padding: 0.5rem 1rem;
  }

  .navbar-logo {
    height: 50px;
    width: auto;
    min-width: 50px;
  }

  .brand-text {
    color: #8F00FF;
    font-size: 1.5rem;
    transition: all 0.3s ease;
  }

  .nav-link {
    color: #00F6FF !important;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
  }

  /* Active State */
  .nav-link.active {
    color: white !important;
    font-weight: bold;
  }

  /* Hover Effects */
  .nav-link:hover {
    color: #8F00FF !important;
    text-shadow: 0 0 8px rgba(143, 0, 255, 0.5);
  }

  .navbar-brand:hover .brand-text {
    color: #00F6FF !important;
    text-shadow: 0 0 8px rgba(0, 246, 255, 0.5);
  }

  /* Search Styles */
  .search-input {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: white !important;
    border-color: #8F00FF !important;
    min-width: 200px;
  }

  .search-btn {
    background-color: #8F00FF !important;
    color: white !important;
  }

  /* Badge Styles */
  .cart-badge {
    background-color: #8F00FF;
    color: white;
  }

  .notification-badge {
    background-color: #00F6FF;
    color: black;
  }

  /* Dropdown Styles */
  .dropdown-menu {
    background-color: rgba(15, 15, 15, 0.95);
    border: 1px solid #333;
  }

  .dropdown-item {
    color: #00F6FF !important;
    padding: 0.5rem 1rem;
  }

  .dropdown-item:hover {
    background-color: rgba(143, 0, 255, 0.2) !important;
  }

  .dropdown-header {
    color: #8F00FF !important;
  }

  .dropdown-divider {
    border-color: #333;
  }

  /* Theme Toggle */
  .theme-toggle {
    padding: 0.5rem;
  }

  .theme-icon-light,
  .theme-icon-dark {
    font-size: 1.2rem;
  }

  /* Mobile Responsiveness */
  @media (max-width: 992px) {
    .navbar-brand span {
      font-size: 1.3rem !important;
    }

    .search-form {
      order: 3;
      width: 100%;
      margin: 1rem 0;
      display: none;
    }

    .search-form.show {
      display: flex;
    }

    .navbar-collapse {
      padding: 1rem;
      background-color: rgba(15, 15, 15, 0.95);
      backdrop-filter: blur(10px);
    }

    .navbar-nav {
      width: 100%;
    }

    .nav-item {
      margin: 0.5rem 0;
    }

    .dropdown-menu {
      position: static !important;
      transform: none !important;
      width: 100%;
      margin-top: 0.5rem;
    }
  }

  @media (min-width: 992px) {
    .search-form {
      min-width: 300px;
    }
  }
</style>

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Theme toggle functionality
    const themeToggle = document.getElementById('themeToggle');
    const themeIconDark = document.querySelector('.theme-icon-dark');
    const themeIconLight = document.querySelector('.theme-icon-light');

    // Check for saved theme preference or use preferred color scheme
    const currentTheme = localStorage.getItem('theme') ||
      (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

    // Apply the current theme
    applyTheme(currentTheme);

    // Toggle theme on button click
    themeToggle.addEventListener('click', function () {
      const currentTheme = document.documentElement.getAttribute('data-bs-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      applyTheme(newTheme);
      localStorage.setItem('theme', newTheme);
    });

    function applyTheme(theme) {
      if (theme === 'dark') {
      document.documentElement.setAttribute('data-bs-theme', 'dark');
      themeIconDark.classList.add('d-none');
      themeIconLight.classList.remove('d-none');
      } else {
      document.documentElement.setAttribute('data-bs-theme', 'light');
      themeIconLight.classList.add('d-none');
      themeIconDark.classList.remove('d-none');
      }
    }

    // Mobile search toggle (optional)
    const navbarToggler = document.querySelector('.navbar-toggler');
    const searchForm = document.querySelector('.search-form');

    navbarToggler.addEventListener('click', function () {
      if (window.innerWidth < 992) {
      searchForm.classList.toggle('show');
      }
    });

    // Close mobile menu when clicking on a link
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', function () {
      if (window.innerWidth < 992) {
        const collapse = document.querySelector('.navbar-collapse');
        bootstrap.Collapse.getInstance(collapse)?.hide();
      }
      });
    });
    });
  </script>
@endpush