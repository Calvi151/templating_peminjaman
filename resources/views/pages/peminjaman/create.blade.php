@extends('layouts.app')

@section('content')
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">Formulir Peminjaman Barang</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Informasi Barang</h6>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Pilih Barang</label>
                                <select name="barang_id" class="form-control form-control-alternative" required>
                                    <option value="">-- Pilih Barang yang Tersedia --</option>
                                    @foreach($barangs as $b)
                                        <option value="{{ $b->id }}">{{ $b->nama_barang }} (Stok: {{ $b->stok }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Jumlah Pinjam</label>
                                <input type="number" name="jumlah_pinjam" class="form-control form-control-alternative" placeholder="Masukkan jumlah" min="1" required>
                            </div>
                        </div>

                        <hr class="my-4" />
                        <h6 class="heading-small text-muted mb-4">Waktu Peminjaman</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Tanggal Pinjam</label>
                                        <input type="date" name="tgl_pinjam" class="form-control form-control-alternative" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Rencana Kembali</label>
                                        <input type="date" name="tgl_kembali" class="form-control form-control-alternative" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-neutral">Batal</a>
                            <button type="submit" class="btn btn-sm btn-primary">Kirim Pengajuan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection