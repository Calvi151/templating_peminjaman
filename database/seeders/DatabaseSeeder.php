<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Atmin',
            'email' => 'atmin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun User (Peminjam)
        User::create([
            'name' => 'Gigis',
            'email' => 'gigis@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);

        // 3. Buat Kategori
        $elektronik = Category::create(['nama_kategori' => 'Elektronik']);
        $atk = Category::create(['nama_kategori' => 'Alat Tulis']);

        // 4. Buat Barang Contoh
        Barang::create([
            'category_id' => $elektronik->id,
            'nama_barang' => 'Laptop ASUS',
            'kode_barang' => 'LAP-001',
            'stok' => 10,
            'deskripsi' => 'Laptop  desain'
        ]);

        Barang::create([
            'category_id' => $atk->id,
            'nama_barang' => 'Proyektor Epson',
            'kode_barang' => 'PRO-021',
            'stok' => 5,
            'deskripsi' => 'Proyektor ruang kelas'
        ]);
    }
}