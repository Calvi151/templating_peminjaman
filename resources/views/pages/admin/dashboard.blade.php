@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', Auth::user()->role == 'admin' ? 'Dashboard Admin' : 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')

@php $isAdmin = Auth::user()->role == 'admin'; @endphp

{{-- ════════════════════════════════════════
     STAT CARDS
════════════════════════════════════════ --}}
<div class="row">

  @if($isAdmin)
  {{-- ── ADMIN: 4 kartu ──────────────────────── --}}

    {{-- Total Barang --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Barang</p>
                <h5 class="font-weight-bolder">{{ $countBarang }}</h5>
                <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">Aktif</span>
                  dalam inventaris
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-box-2 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Menunggu Approval (status: waiting) --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Menunggu Approval</p>
                <h5 class="font-weight-bolder">{{ $countPending }}</h5>
                <p class="mb-0">
                  <span class="text-danger text-sm font-weight-bolder">Perlu</span>
                  ditindaklanjuti
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="ni ni-bell-55 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Sedang Dipinjam (status: approved) --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Sedang Dipinjam</p>
                <h5 class="font-weight-bolder">{{ $countApproved }}</h5>
                <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">Aktif</span>
                  saat ini
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Total Kategori --}}
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Kategori</p>
                <h5 class="font-weight-bolder">{{ $statsKategori->count() }}</h5>
                <p class="mb-0">
                  <span class="text-info text-sm font-weight-bolder">Jenis</span>
                  kategori barang
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="ni ni-tag text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  @else
  {{-- ── USER: 3 kartu ───────────────────────── --}}

    {{-- Sedang Dipinjam --}}
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Sedang Dipinjam</p>
                <h5 class="font-weight-bolder">{{ $countPinjam }}</h5>
                <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">Aktif</span>
                  saat ini
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Menunggu Persetujuan --}}
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Menunggu Persetujuan</p>
                <h5 class="font-weight-bolder">{{ $countPending }}</h5>
                <p class="mb-0">
                  <span class="text-warning text-sm font-weight-bolder">Proses</span>
                  oleh admin
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="ni ni-time-alarm text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Total Riwayat --}}
    <div class="col-xl-4 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Riwayat</p>
                <h5 class="font-weight-bolder">{{ $myPinjam->count() }}</h5>
                <p class="mb-0">
                  <span class="text-info text-sm font-weight-bolder">Semua</span>
                  transaksi saya
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-info shadow text-center rounded-circle">
                <i class="ni ni-bullet-list-67 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  @endif

</div>
{{-- ════ END STAT CARDS ════ --}}


{{-- ════════════════════════════════════════
     KONTEN TENGAH (berbeda per role)
════════════════════════════════════════ --}}
<div class="row mt-4">

  @if($isAdmin)
  {{-- ── ADMIN: Chart + List Kategori ───────── --}}

    {{-- Chart --}}
    <div class="col-lg-7 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Statistik Peminjaman</h6>
          <p class="text-sm mb-0">
            <i class="fa fa-arrow-up text-success"></i>
            <span class="font-weight-bold">Aktivitas</span> 6 bulan terakhir
          </p>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>

    {{-- List Kategori --}}
    <div class="col-lg-5">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Statistik Barang per Kategori</h6>
        </div>
        <div class="card-body p-3">
          <ul class="list-group">
            @forelse($statsKategori as $cat)
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                    <i class="ni ni-tag text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    {{-- Pakai null-safe: coba kolom 'name' dulu, fallback ke 'nama_kategori' --}}
                    <h6 class="mb-1 text-dark text-sm">
                      {{ $cat->name ?? $cat->nama_kategori ?? '-' }}
                    </h6>
                    <span class="text-xs">
                      <span class="font-weight-bold">{{ $cat->barangs_count }}</span> jenis barang
                    </span>
                  </div>
                </div>
                <div class="d-flex">
                  <a href="{{ route('barang.index') }}"
                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                    <i class="ni ni-bold-right" aria-hidden="true"></i>
                  </a>
                </div>
              </li>
            @empty
              <li class="list-group-item border-0 ps-0">
                <p class="text-sm text-secondary text-center mb-0 py-3">
                  Belum ada kategori.
                </p>
              </li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>

  @else
  {{-- ── USER: Banner ajukan pinjaman ──────── --}}

    <div class="col-12">
      <div class="card">
        <div class="card-body p-4 text-center">
          <div class="icon icon-shape icon-lg bg-gradient-primary shadow-primary text-center rounded-circle mx-auto mb-3">
            <i class="ni ni-cart text-xl opacity-10"></i>
          </div>
          <h5 class="font-weight-bolder mb-1">Butuh meminjam barang?</h5>
          <p class="text-sm text-secondary mb-3">
            Ajukan permintaan peminjaman dan tunggu persetujuan dari admin.
          </p>
          <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm mb-0">
            <i class="ni ni-fat-add me-1"></i> Ajukan Peminjaman Baru
          </a>
        </div>
      </div>
    </div>

  @endif

</div>
{{-- ════ END KONTEN TENGAH ════ --}}


{{-- ════════════════════════════════════════
     TABEL $myPinjam
     Admin  → 5 aktivitas terbaru (semua user)
     User   → riwayat pinjaman sendiri
════════════════════════════════════════ --}}
<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0 p-3">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="mb-0">
            {{ $isAdmin ? 'Aktivitas Peminjaman Terbaru' : 'Riwayat Pinjam Saya' }}
          </h6>
          <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-outline-primary mb-0">
            {{ $isAdmin ? 'Lihat Semua' : 'Lihat Detail' }}
          </a>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                @if($isAdmin)
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Peminjam
                  </th>
                @endif
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7
                  {{ $isAdmin ? 'ps-2' : 'px-3' }}">
                  Barang
                </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                  Tanggal
                </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                  Status
                </th>
                @if($isAdmin)
                  <th class="text-secondary opacity-7"></th>
                @endif
              </tr>
            </thead>
            <tbody>

              @forelse($myPinjam as $item)
                @php
                  $statusClass = match($item->status ?? 'waiting') {
                    'approved' => 'bg-gradient-success',
                    'rejected' => 'bg-gradient-danger',
                    'returned' => 'bg-gradient-info',
                    default    => 'bg-gradient-warning',  // waiting
                  };
                  $statusLabel = match($item->status ?? 'waiting') {
                    'approved' => 'Disetujui',
                    'rejected' => 'Ditolak',
                    'returned' => 'Dikembalikan',
                    default    => 'Menunggu',
                  };
                @endphp
                <tr>
                  @if($isAdmin)
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $item->user->name ?? '-' }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $item->user->email ?? '-' }}</p>
                        </div>
                      </div>
                    </td>
                  @endif

                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $item->barang->nama_barang ?? '-' }}</h6>
                        @if(!$isAdmin)
                          <p class="text-xs text-secondary mb-0">
                            {{ $item->barang->category->name
                              ?? $item->barang->category->nama_kategori
                              ?? '-' }}
                          </p>
                        @endif
                      </div>
                    </div>
                  </td>

                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">
                      {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                    </span>
                  </td>

                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm {{ $statusClass }}">{{ $statusLabel }}</span>
                  </td>

                  @if($isAdmin)
                    <td class="align-middle">
                      <a href="{{ route('peminjaman.index') }}"
                        class="text-secondary font-weight-bold text-xs">
                        Detail
                      </a>
                    </td>
                  @endif
                </tr>
              @empty
                <tr>
                  <td colspan="{{ $isAdmin ? 5 : 3 }}"
                    class="text-center text-secondary text-sm py-4">
                    @if($isAdmin)
                      Belum ada aktivitas peminjaman.
                    @else
                      Belum ada riwayat peminjaman.
                      <a href="{{ route('peminjaman.create') }}"
                        class="text-primary font-weight-bold ms-1">
                        Ajukan sekarang →
                      </a>
                    @endif
                  </td>
                </tr>
              @endforelse

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- ════ END TABEL ════ --}}

@endsection


{{-- Chart hanya di-render untuk admin --}}
@if(Auth::user()->role == 'admin')
@push('scripts')
<script>
  // 1. Ambil data dari PHP ke variabel JS di awal (Ini cara paling aman dari error IDE)
  const chartLabelsData = {!! json_encode($chartLabels ?? []) !!};
  const chartValuesData = {!! json_encode($chartData ?? []) !!};

  var ctx = document.getElementById("chart-line");
  
  if (ctx) {
    var context = ctx.getContext("2d");
    
    // Pembuatan Gradient
    var grad = context.createLinearGradient(0, 230, 0, 50);
    grad.addColorStop(1,   'rgba(94, 114, 228, 0.2)');
    grad.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    grad.addColorStop(0,   'rgba(94, 114, 228, 0)');

    new Chart(context, {
      type: "line",
      data: {
        labels: chartLabelsData, // Pakai variabel yang sudah didefinisikan di atas
        datasets: [{
          label: "Peminjaman",
          tension: 0.4,
          borderWidth: 3,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: grad,
          fill: true,
          data: chartValuesData, // Pakai variabel yang sudah didefinisikan di atas
          maxBarThickness: 6
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { 
            legend: { display: false } 
        },
        interaction: { 
            intersect: false, 
            mode: 'index' 
        },
        scales: {
          y: {
            grid: { drawBorder: false, display: true, drawTicks: false, borderDash: [5,5] },
            ticks: { 
                display: true, 
                padding: 10, 
                color: '#fbfbfb',
                font: { size: 11, family: "Open Sans", lineHeight: 2 } 
            }
          },
          x: {
            grid: { drawBorder: false, display: false, drawTicks: false },
            ticks: { 
                display: true, 
                color: '#ccc', 
                padding: 20,
                font: { size: 11, family: "Open Sans", lineHeight: 2 } 
            }
          },
        },
      },
    });
  }
</script>
@endpush
@endif