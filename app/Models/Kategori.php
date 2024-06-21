<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = ['deskripsi','kategori'];

    public static function gKategoriAll()
    {
        return DB::table('kategori')->select('kategori.id', 'deskripsi', DB::raw('infoKategori(kategori) as Info'))->get();
    }

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }

    public static function getKategoriAll()
    {
        return DB::table('kategori')
            ->select('kategori.id', 'deskripsi', DB::raw('ketKategori(kategori) as ketkategori'), 'kategori') // Add 'kategori' here
            ->get();
    }
    // public static function getKategoriAll()
    // {
    //     return DB::table('kategori')
    //         ->select('id', 'deskripsi', DB::raw('ketKategori(kategori) as ketkategori'))
    //         ->get();
    // }

    public static function katShowAll(){
        return DB::table('kategori')
                ->join('barang','kategori.id','=','barang.kategori_id')
                ->select('kategori.id','deskripsi',DB::raw('ketKategori(kategori) as ketkategori'),
                         'barang.merk');
    }

    public static function showKategoriById($id){
        return DB::table('kategori')
                ->leftJoin('barang','kategori.id','=','barang.kategori_id')
                ->select('kategori.id','barang.id','kategori.deskripsi',DB::raw('ketKategori(kategori.kategori) as ketkategori'),
                         'barang.merk','barang.seri','barang.spesifikasi','barang.stok')
                ->where('kategori.id','=',$id)
                ->get();
    }
    public static function search($query){
        return DB::table('kategori')
            ->select('kategori.id', 'deskripsi', DB::raw('ketKategori(kategori) as ketkategori'), 'kategori')
            ->where('deskripsi', 'LIKE', "%{$query}%")
            ->orWhere('kategori', 'LIKE', "%{$query}%")
            ->get();
    }
}
