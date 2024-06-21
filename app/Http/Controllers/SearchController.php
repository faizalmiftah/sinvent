<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Search in Barang
        $barangs = Barang::search($query);

        // Search in Kategori
        $kategoris = Kategori::search($query);

        // Return results to a combined view
        return view('search.index', ['barangs' => $barangs, 'kategoris' => $kategoris]);

        // if($request->search){
        //     $rsetKategori = DB::table('vKategori')
        //         ->select('id', 'deskripsi', 'kategori', 'kat')
        //         ->paginate(2);
        // }
    }


}