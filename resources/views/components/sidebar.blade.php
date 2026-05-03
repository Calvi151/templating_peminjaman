<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
  id="sidenav-main">

  {{-- ── Brand / Header ── --}}
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/img/logo-ct-dark.png') }}"
        class="navbar-brand-img h-100" width="26" height="26" alt="logo">
      <span class="ms-1 font-weight-bold">Inventaris App</span>
    </a>
  </div>

  <hr class="horizontal dark mt-0">

  {{-- ── Nav Items ── --}}
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">

      @auth

        {{-- ════════════════════════════
             MENU ADMIN
        ════════════════════════════ --}}
        @if(Auth::user()->role == 'admin')

          <li class="nav-item">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mt-2">
              Menu Utama
            </h6>
          </li>

          {{-- Dashboard --}}
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
              href="{{ route('dashboard') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          </li>

          {{-- Kelola Barang --}}
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}"
              href="{{ route('barang.index') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-box-2 text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Kelola Barang</span>
            </a>
          </li>

          {{-- Approval Peminjaman --}}
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}"
              href="{{ route('peminjaman.index') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-bell-55 text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Approval Peminjaman</span>

              {{-- Badge jumlah pending --}}
              @php $pendingCount = \App\Models\Peminjaman::where('status','pending')->count(); @endphp
              @if($pendingCount > 0)
                <span class="badge badge-sm bg-gradient-danger ms-auto">{{ $pendingCount }}</span>
              @endif
            </a>
          </li>

        {{-- ════════════════════════════
             MENU USER BIASA
        ════════════════════════════ --}}
        @else

          <li class="nav-item">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mt-2">
              Menu
            </h6>
          </li>

          {{-- Ajukan Peminjaman --}}
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('peminjaman.create') ? 'active' : '' }}"
              href="{{ route('peminjaman.create') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-cart text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Ajukan Peminjaman</span>
            </a>
          </li>

          {{-- Status Pinjaman --}}
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}"
              href="{{ route('peminjaman.index') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Status Pinjaman</span>
            </a>
          </li>

        @endif

        {{-- ════════════════════════════
             AKUN (semua role)
        ════════════════════════════ --}}
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Akun</h6>
        </li>

        {{-- Profile --}}
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="#">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">{{ Auth::user()->name }}</span>
          </a>
        </li>

        {{-- Logout --}}
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
          </form>
          <a class="nav-link cursor-pointer" href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-user-run text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>

      @endauth

    </ul>
  </div>

</aside>