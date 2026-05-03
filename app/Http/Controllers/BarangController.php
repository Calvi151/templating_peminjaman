<?php
namespace App\Http\Controllers;

use App\Models\Barang; // Import Model Barang
use App\Models\Category; // Import Model Category
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
{
    $query = Barang::with('category');

    // Filter berdasarkan kategori jika ada request
    if ($request->has('category_id') && $request->category_id != '') {
        $query->where('category_id', $request->category_id);
    }

    $barangs = $query->latest()->get();
    $categories = Category::all(); // Untuk tombol filter
    
    return view('pages.barang.index', compact('barangs', 'categories'));
}
    
    public function create()
    {
        $categories = Category::all();
        return view('pages.barang.create', compact('categories'));
    }

    public function store(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'nama_barang' => 'required',
        'category_id' => 'required',
        'kode_barang' => 'required|unique:barangs',
        'stok'        => 'required|integer',
    ]);

    // 2. Simpan ke Database
    Barang::create($request->all());

    // 3. Redirect kembali ke Index dengan pesan sukses
    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
}

// Menampilkan form edit
public function edit(Barang $barang)
{
    $categories = Category::all();
    return view('pages.barang.edit', compact('barang', 'categories'));
}

// Memperbarui data ke database
public function update(Request $request, Barang $barang)
{
    $request->validate([
        'nama_barang' => 'required',
        'category_id' => 'required',
        'kode_barang' => 'required|unique:barangs,kode_barang,' . $barang->id,
        'stok'        => 'required|integer',
    ]);

    $barang->update($request->all());
    return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
}

// Menghapus barang
public function destroy(Barang $barang)
{
    $barang->delete();
    return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
}
}