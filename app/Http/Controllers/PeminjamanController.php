<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use App\Models\Barang; // Import model Barang di sini

class PeminjamanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Admin melihat semua ajuan
        if ($user->role === 'admin') {
            $peminjamans = Peminjaman::with(['user', 'barang'])->latest()->get();
            // PERBAIKAN: Harus ada return view untuk Admin
            return view('pages.peminjaman.index', compact('peminjamans'));
        } 
        
        // User hanya melihat miliknya sendiri
        $peminjamans = Peminjaman::with(['barang'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
            
        return view('pages.peminjaman.user_index', compact('peminjamans'));
    }

    public function approve($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $barang = $pinjam->barang;

        if ($barang->stok >= $pinjam->jumlah_pinjam) {
            // Kurangi stok barang
            $barang->stok -= $pinjam->jumlah_pinjam;
            $barang->save();

            // Ubah status peminjaman
            $pinjam->update(['status' => 'approved']);

            return back()->with('success', 'Peminjaman disetujui dan stok barang telah dikurangi!');
        }
        
        return back()->with('error', 'Stok barang tidak mencukupi!');
    }

    public function reject($id)
    {
        Peminjaman::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Peminjaman telah ditolak.');
    }

    public function create()
    {
        // Mengambil barang yang stoknya tersedia
        $barangs = Barang::where('stok', '>', 0)->get();
        return view('pages.peminjaman.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
        ]);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => 'waiting',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function returnBarang($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $barang = $pinjam->barang;

        // Pastikan barang memang sedang dalam status dipinjam (approved)
        if ($pinjam->status === 'approved') {
            // Tambahkan kembali stok barang sesuai jumlah yang dipinjam
            $barang->stok += $pinjam->jumlah_pinjam;
            $barang->save();

            // Ubah status peminjaman menjadi returned
            $pinjam->update(['status' => 'returned']);

            return back()->with('success', 'Barang berhasil dikembalikan dan stok telah bertambah!');
        }

        return back()->with('error', 'Status peminjaman tidak valid untuk dikembalikan.');
    }
}