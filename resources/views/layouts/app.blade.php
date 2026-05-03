<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

  <title>@yield('title', 'Aplikasi Peminjaman')</title>

  {{-- Google Fonts --}}
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  {{-- Nucleo Icons — pakai CDN agar pasti load tanpa butuh file lokal --}}
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />

  {{-- Font Awesome 6 via CDN --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  {{-- Argon Dashboard CSS (file lokal di public/assets/css/) --}}
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />

  @stack('styles')
</head>

<body class="g-sidenav-show bg-gray-100">

  {{-- Header dark background strip --}}
  <div class="min-height-300 bg-dark position-absolute w-100"></div>

  {{-- Sidebar --}}
  @include('components.sidebar')

  {{-- Main Content --}}
  <main class="main-content position-relative border-radius-lg">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Page Content --}}
    <div class="container-fluid py-4">

      {{-- ── Flash Messages ── --}}
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
          <span class="alert-icon align-middle">
            <i class="ni ni-like-2 text-sm"></i>
          </span>
          <span class="alert-text text-white">
            <strong>Berhasil!</strong> {{ session('success') }}
          </span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
          <span class="alert-icon align-middle">
            <i class="ni ni-support-16 text-sm"></i>
          </span>
          <span class="alert-text text-white">
            <strong>Gagal!</strong> {{ session('error') }}
          </span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
          <span class="alert-icon align-middle">
            <i class="ni ni-bell-55 text-sm"></i>
          </span>
          <span class="alert-text text-white">
            <strong>Perhatian!</strong>
            <ul class="mb-0 mt-1">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      {{-- ── End Flash Messages ── --}}

      @yield('content')

      {{-- Footer --}}
      <footer class="footer pt-3">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                &copy; {{ date('Y') }}, dibuat dengan <i class="fa fa-heart text-danger"></i> oleh Tim Dev.
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div>
  </main>

  {{-- ── Core JS ── --}}
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

  {{-- Smooth scrollbar init --}}
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = { damping: '0.5' };
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  {{-- Argon Dashboard JS (harus paling akhir) --}}
  <script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>

  @stack('scripts')
</body>

</html>