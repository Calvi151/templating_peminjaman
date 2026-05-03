<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
  id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">

    {{-- ── Breadcrumb & Page Title ── --}}
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">
          <a class="opacity-5 text-white" href="{{ route('dashboard') }}">Halaman</a>
        </li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">
          @yield('breadcrumb', 'Dashboard')
        </li>
      </ol>
      {{-- Page title yang lebih besar di bawah breadcrumb --}}
      <h6 class="font-weight-bolder text-white mb-0">
        @yield('page_title', 'Dashboard')
      </h6>
    </nav>

    {{-- ── Right Side ── --}}
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

      {{-- Search Bar --}}
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group">
          <span class="input-group-text text-body">
            <i class="fas fa-search" aria-hidden="true"></i>
          </span>
          <input type="text" class="form-control" placeholder="Cari...">
        </div>
      </div>

      <ul class="navbar-nav justify-content-end">

        {{-- User Info --}}
        <li class="nav-item d-flex align-items-center">
          <a href="#" class="nav-link text-white font-weight-bold px-0">
            <i class="fa fa-user me-sm-1"></i>
            <span class="d-sm-inline d-none">
              @auth {{ Auth::user()->name }} @else Guest @endauth
            </span>
          </a>
        </li>

        {{-- Sidenav Toggle (mobile) --}}
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
            </div>
          </a>
        </li>

        {{-- Notifications Dropdown --}}
        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0"
            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell cursor-pointer"></i>
            {{-- Badge jika ada notif --}}
            @auth
              @php
                $notifCount = \App\Models\Peminjaman::when(Auth::user()->role != 'admin',
                  fn($q) => $q->where('user_id', Auth::id())
                )->where('status','pending')->count();
              @endphp
              @if($notifCount > 0)
                <span class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger"
                  style="font-size:9px; padding:2px 5px;">
                  {{ $notifCount }}
                </span>
              @endif
            @endauth
          </a>

          <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
            aria-labelledby="dropdownMenuButton">
            @auth
              @if(Auth::user()->role == 'admin')
                {{-- Notif untuk admin: permintaan pending --}}
                @php
                  $recentNotif = \App\Models\Peminjaman::with('user')
                    ->where('status','pending')
                    ->latest()->take(3)->get();
                @endphp
                @forelse($recentNotif as $notif)
                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="{{ route('peminjaman.index') }}">
                      <div class="d-flex py-1">
                        <div class="my-auto me-3">
                          <div class="icon icon-shape icon-sm bg-gradient-warning shadow text-center rounded-circle">
                            <i class="ni ni-bell-55 text-white text-xs opacity-10"></i>
                          </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="text-sm font-weight-normal mb-1">
                            <span class="font-weight-bold">Permintaan baru</span>
                            dari {{ $notif->user->name ?? 'User' }}
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                            <i class="fa fa-clock me-1"></i>
                            {{ $notif->created_at->diffForHumans() }}
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                @empty
                  <li>
                    <p class="text-xs text-center text-muted px-2 py-1 mb-0">
                      Tidak ada notifikasi baru.
                    </p>
                  </li>
                @endforelse
              @else
                {{-- Notif untuk user: update status pinjaman --}}
                @php
                  $recentNotif = \App\Models\Peminjaman::with('barang')
                    ->where('user_id', Auth::id())
                    ->whereIn('status',['approved','rejected'])
                    ->latest()->take(3)->get();
                @endphp
                @forelse($recentNotif as $notif)
                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="{{ route('peminjaman.index') }}">
                      <div class="d-flex py-1">
                        <div class="my-auto me-3">
                          <div class="icon icon-shape icon-sm
                            {{ $notif->status == 'approved' ? 'bg-gradient-success' : 'bg-gradient-danger' }}
                            shadow text-center rounded-circle">
                            <i class="ni {{ $notif->status == 'approved' ? 'ni-check-bold' : 'ni-fat-remove' }}
                              text-white text-xs opacity-10"></i>
                          </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="text-sm font-weight-normal mb-1">
                            Pinjaman
                            <span class="font-weight-bold {{ $notif->status == 'approved' ? 'text-success' : 'text-danger' }}">
                              {{ $notif->status == 'approved' ? 'disetujui' : 'ditolak' }}
                            </span>
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                            {{ $notif->barang->nama_barang ?? '-' }} &mdash;
                            <i class="fa fa-clock me-1"></i>{{ $notif->updated_at->diffForHumans() }}
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                @empty
                  <li>
                    <p class="text-xs text-center text-muted px-2 py-1 mb-0">
                      Tidak ada notifikasi baru.
                    </p>
                  </li>
                @endforelse
              @endif
            @endauth
          </ul>
        </li>

      </ul>
    </div>
    {{-- ── End Right Side ── --}}

  </div>
</nav>