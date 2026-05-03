@extends('layouts.app') {{-- Pastikan ini mengarah ke layout utama Argon Dashboard --}}

@section('title', 'Persetujuan Peminjaman')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>Daftar Pengajuan Peminjaman Inventaris</h6>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                @if (session('success'))
                    <div class="alert alert-success text-white mx-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger text-white mx-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Peminjam</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Barang</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl. Pinjam</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl. Kembali (Rencana)</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-secondary opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- PERBAIKAN 1: Mengubah $peminjaman menjadi $peminjamans agar sesuai dengan Controller --}}
                            @forelse ($peminjamans as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('assets/img/team-2.jpg') }}" class="avatar avatar-sm me-3" alt="user">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->user->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $item->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->barang->nama_barang }}</p>
                                        <p class="text-xs text-secondary mb-0">Kode: {{ $item->barang->kode_barang }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->jumlah_pinjam }}</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M Y') }}</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        {{-- PERBAIKAN 2: Mengubah 'pending' menjadi 'waiting' agar sesuai nilai Enum di Database --}}
                                        @if ($item->status == 'waiting')
                                            <span class="badge badge-sm bg-gradient-warning">Waiting</span>
                                        @elseif ($item->status == 'approved')
                                            <span class="badge badge-sm bg-gradient-success">Disetujui</span>
                                        @elseif ($item->status == 'rejected')
                                            <span class="badge badge-sm bg-gradient-danger">Ditolak</span>
                                        @elseif ($item->status == 'returned')
                                            <span class="badge badge-sm bg-gradient-info">Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        {{-- PERBAIKAN 3: Menyesuaikan status form dan menambah form Terima Kembali --}}
                                        @if ($item->status == 'waiting')
                                            <form action="{{ route('admin.peminjaman.approve', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success m-0" title="Setujui">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.peminjaman.reject', $item->id) }}" method="POST" class="d-inline ms-2">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger m-0" title="Tolak">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>
                                            </form>
                                        
                                        {{-- TAMBAHAN: Munculkan form Terima Pengembalian HANYA jika status sudah disetujui (dipinjam) --}}
                                        @elseif ($item->status == 'approved')
                                            <form action="{{ route('admin.peminjaman.return', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-info m-0" title="Terima Pengembalian">
                                                    <i class="fas fa-undo"></i> Terima Kembali
                                                </button>
                                            </form>
                                        
                                        @else
                                            <span class="text-secondary text-xs font-weight-bold">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada pengajuan peminjaman saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection