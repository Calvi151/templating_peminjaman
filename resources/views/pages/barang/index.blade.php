@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Daftar Barang Inventaris</h6>
                        <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary mb-0">
                            <i class="ni ni-fat-add me-1"></i> Tambah Barang
                        </a>
                    </div>
                    
                    <div class="mt-3">
                        <small class="text-uppercase text-muted font-weight-bold">Filter Kategori:</small>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <a href="{{ route('barang.index') }}" class="btn btn-xs {{ !request('category_id') ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
                            @foreach($categories as $cat)
                                <a href="{{ route('barang.index', ['category_id' => $cat->id]) }}" 
                                   class="btn btn-xs {{ request('category_id') == $cat->id ? 'btn-primary' : 'btn-outline-primary' }}">
                                    {{ $cat->nama_kategori }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Barang</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barangs as $b)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <h6 class="mb-0 text-sm">{{ $b->kode_barang }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $b->nama_barang }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">{{ $b->category->nama_kategori ?? 'N/A' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $b->stok }} unit</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('barang.destroy', $b->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-secondary">Tidak ada data untuk kategori ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection