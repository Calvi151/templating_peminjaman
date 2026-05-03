<li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="ni ni-tv-2 text-primary"></i> Dashboard
    </a>
</li>

@if(auth()->user()->role == 'admin')
<li class="nav-item">
    <a class="nav-link" href="{{ route('barang.index') }}">
        <i class="ni ni-archive-2 text-green"></i> Kelola Barang (Admin)
    </a>
</li>
@endif

@if(auth()->user()->role == 'user')
<li class="nav-item">
    <a class="nav-link" href="{{ route('peminjaman.create') }}">
        <i class="ni ni-send text-orange"></i> Ajukan Pinjaman
    </a>
</li>
@endif