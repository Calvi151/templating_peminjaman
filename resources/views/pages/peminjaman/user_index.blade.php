@extends('layouts.app')

@section('content')
<div class="container-fluid mt--6">
    <div class="card shadow">
        <div class="card-header border-0 d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Riwayat Peminjaman Saya</h3>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-sm btn-primary">Tambah Peminjaman</a>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @forelse($peminjamans as $p)
                    <tr>
                        <td class="font-weight-bold">
                            {{ $p->barang->nama_barang }}
                        </td>
                        <td>{{ $p->jumlah_pinjam }} Unit</td>
                        <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y, H:i') }}</td>
                        <td class="text-center">
                            @php
                                $color = 'secondary';
                                if($p->status == 'waiting') $color = 'warning';
                                elseif($p->status == 'approved') $color = 'success';
                                elseif($p->status == 'rejected') $color = 'danger';
                            @endphp
                            <span class="badge badge-pill bg-gradient-{{ $color }} text-white">
                                {{ strtoupper($p->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($p->status == 'waiting')
                                <span class="badge badge-sm bg-gradient-warning">Menunggu</span>
                            @elseif ($p->status == 'approved')
                                <span class="badge badge-sm bg-gradient-success">Dipinjam</span>
                            @elseif ($p->status == 'returned')
                                <span class="badge badge-sm bg-gradient-info">Dikembalikan</span>
                            @elseif ($p->status == 'rejected')
                                <span class="badge badge-sm bg-gradient-danger">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <p class="mb-0">Kamu belum pernah meminjam barang.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection