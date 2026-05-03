@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Edit Barang Inventaris</h6>
                        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-secondary mb-0">
                            <i class="ni ni-bold-left me-1"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Kode Barang -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Barang</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" required>
                                        @error('kode_barang')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Nama Barang -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                                        @error('nama_barang')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $barang->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Stok -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok', $barang->stok) }}" min="0" required>
                                        @error('stok')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group">
                            <label class="form-control-label text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea class="form-control @error('deskripsisi') is-invalid @enderror" name="deskripsisi" rows="4">{{ old('deskripsisi', $barang->deskripsisi) }}</textarea>
                                @error('deskripsisi')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Simpan & Batal -->
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ni ni-check-bold me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer seperti halaman sebelumnya -->
    <footer class="footer pt-3">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>document.write(new Date().getFullYear())</script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="#" class="font-weight-bold" target="_blank">Tim Pengembang</a>
                        untuk sistem yang lebih baik.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item"><a href="#" class="nav-link text-muted" target="_blank">Tentang Kami</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-muted" target="_blank">Panduan</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-muted" target="_blank">Blog</a></li>
                        <li class="nav-item"><a href="#" class="nav-link pe-0 text-muted" target="_blank">Lisensi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection