<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';

    protected $fillable = ['merk','seri','spesifikasi','stok','kategori_id','foto'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function barangmasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }
    public function barangkeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }
    public static function search($query)
    {
        return self::where('merk', 'LIKE', "%{$query}%")
                    ->orWhere('seri', 'LIKE', "%{$query}%")
                    ->orWhere('spesifikasi', 'LIKE', "%{$query}%")
                    ->orWhere('stok', 'LIKE', "%{$query}%")
                    ->get();
    }

}
