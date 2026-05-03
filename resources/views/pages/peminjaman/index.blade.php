@extends('layouts.app')

@section('content')

<div class="container-fluid mt--4">
    <div class="card shadow">
        <div class="card-header border-0">
            <h2 class="mb-0">Daftar Pengajuan Peminjaman</h2>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort">Peminjam</th>
                        <th scope="col" class="sort">Barang</th>
                        <th scope="col" class="sort">Jumlah</th>
                        <!-- TAMBAHAN: Mengembalikan kolom tanggal yang sempat hilang -->
                        <th scope="col" class="sort">Masa Pinjam</th>
                        <th scope="col" class="sort">Status</th>
                        <th scope="col" class="sort">Aksi</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @forelse($peminjamans as $p)
                    <tr>
                        <td class="font-weight-bold">{{ $p->user->name }}</td>
                        <td>{{ $p->barang->nama_barang }}</td>
                        <td>{{ $p->jumlah_pinjam }} Unit</td>
                        
                        <!-- TAMBAHAN: Logika Cerdas Menampilkan Tanggal -->
                        <td>
                            <div class="text-sm">
                                <span class="text-muted">Mulai:</span> 
                                <span class="font-weight-bold">{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}</span>
                                <br>
                                
                                @if($p->status == 'returned')
                                    {{-- Jika sudah dikembalikan, ambil waktu dari updated_at (waktu aktual tombol diklik) --}}
                                    <span class="text-info text-xs">Dikembalikan:</span> 
                                    <span class="font-weight-bold text-info">{{ \Carbon\Carbon::parse($p->updated_at)->format('d M Y - H:i') }}</span>
                                @else
                                    {{-- Jika belum dikembalikan, tampilkan rencana/tenggat waktu (tgl_kembali) --}}
                                    <span class="text-muted text-xs">Tenggat:</span> 
                                    <span class="font-weight-bold text-warning">{{ \Carbon\Carbon::parse($p->tgl_kembali)->format('d M Y') }}</span>
                                @endif
                            </div>
                        </td>

                        <td>
                            <span class="badge badge-sm bg-gradient-{{ $p->status == 'waiting' ? 'warning' : ($p->status == 'approved' ? 'success' : ($p->status == 'returned' ? 'info' : 'danger')) }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            @if(auth()->user()->role == 'admin' && $p->status == 'waiting')
                                <form action="{{ route('peminjaman.approve', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success shadow-none">Setujui</button>
                                </form>
                                <form action="{{ route('peminjaman.reject', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-danger shadow-none">Tolak</button>
                                </form>
                            @elseif(auth()->user()->role == 'admin' && $p->status == 'approved')
                                <form action="{{ route('peminjaman.return', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf 
                                    <button type="submit" class="btn btn-sm btn-info shadow-none">Terima Kembali</button>
                                </form>
                            @else
                                <span class="text-muted text-xs">Tidak ada aksi</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada data peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
@endsection