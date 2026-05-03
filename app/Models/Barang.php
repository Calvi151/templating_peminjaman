<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['category_id', 'nama_barang', 'kode_barang', 'stok', 'deskripsi'];

public function category()
{
    return $this->belongsTo(Category::class);
}

public function peminjamans()
{
    return $this->hasMany(Peminjaman::class);
}
}
