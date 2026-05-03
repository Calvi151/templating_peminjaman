<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ── Inisialisasi semua variabel ──────────────────────────────
        $countBarang   = 0;
        $countPending  = 0;
        $countPinjam   = 0;
        $countApproved = 0;
        $myPinjam      = collect();
        $statsKategori = collect();
        $chartLabels   = [];
        $chartData     = [];

        if ($user->role == 'admin') {

            // ── DATA ADMIN ───────────────────────────────────────────
            $countBarang   = Barang::count();
            $countPending  = Peminjaman::where('status', 'waiting')->count();
            $countApproved = Peminjaman::where('status', 'approved')->count();

            // Statistik kategori (nama kolom sesuai model Category kamu)
            $statsKategori = Category::withCount('barangs')->get();

            // 5 aktivitas peminjaman terbaru
            $myPinjam = Peminjaman::with(['user', 'barang'])->latest()->limit(5)->get();

            // ── Chart: jumlah peminjaman per bulan (6 bulan terakhir) ─
            for ($i = 5; $i >= 0; $i--) {
                $bulan         = now()->subMonths($i);
                $chartLabels[] = $bulan->format('M Y');
                $chartData[]   = Peminjaman::whereYear('created_at', $bulan->year)
                                           ->whereMonth('created_at', $bulan->month)
                                           ->count();
            }

        } else {

            // ── DATA USER BIASA ──────────────────────────────────────
            $countPinjam = Peminjaman::where('user_id', $user->id)
                                     ->where('status', 'approved')
                                     ->count();

            $countPending = Peminjaman::where('user_id', $user->id)
                                      ->where('status', 'waiting')
                                      ->count();

            $myPinjam = Peminjaman::where('user_id', $user->id)
                                   ->with('barang')
                                   ->latest()
                                   ->get();
        }

        return view('pages.admin.dashboard', compact(
            'countBarang',
            'countPending',
            'countPinjam',
            'countApproved',
            'myPinjam',
            'statsKategori',
            'chartLabels',
            'chartData'
        ));
    }
}