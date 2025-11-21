<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Soal B - Manajemen Rumah Sakit & Pasien')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
            color: #0d6efd !important;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .table th {
            border-top: none;
            font-weight: 600;
        }
        .btn-group .btn {
            margin-right: 5px;
        }
        .badge {
            font-size: 0.8em;
        }
        .alert {
            border-radius: 10px;
        }
        .form-control, .form-select {
            border-radius: 8px;
        }
        .btn {
            border-radius: 8px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/rumahsakit') }}">
      <i class="fas fa-clinic-medical text-primary me-2"></i>
      SoalB
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('rumahsakit.*') ? 'active' : '' }}" href="{{ route('rumahsakit.index') }}">
            <i class="fas fa-hospital me-1"></i>Rumah Sakit
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('pasien.*') ? 'active' : '' }}" href="{{ route('pasien.index') }}">
            <i class="fas fa-users me-1"></i>Pasien
          </a>
        </li>
      </ul>
      <ul class="navbar-nav">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->username }}
          </a>
          <ul class="dropdown-menu">
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">
                  <i class="fas fa-sign-out-alt me-1"></i>Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
