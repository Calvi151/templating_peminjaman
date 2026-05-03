@extends('layouts.app')

@section('content')
<div class="container-fluid mt--6">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Tambah Barang Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="Contoh: Laptop" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Kategori</label>
                            <select name="category_id" class="form-control" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" placeholder="BRG-001" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Stok</label>
                            <input type="number" name="stok" class="form-control" value="0" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Barang</button>
            </form>
        </div>
    </div>
</div>
@endsection