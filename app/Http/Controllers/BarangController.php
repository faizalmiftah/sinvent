<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;


class BarangController extends Controller
{
    use ValidatesRequests;
    public function index(Request $request)
    {
        $rsetBarang = Barang::with('kategori')->latest()->paginate(10);

        return view('barang.index', compact('rsetBarang'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $akategori = Kategori::all();
        return view('barang.create',compact('akategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Memulai transaksi
            DB::beginTransaction();
        
            // Validasi input dari request
            $validatedData = $this->validate($request, [
                'merk' => 'required|string|max:50',
                'seri' => 'required|string|max:50',
                'spesifikasi' => 'required|string',
                'stok' => 'integer|min:0',
                'kategori_id' => 'required|exists:kategori,id',
                'foto'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        
            // Default stok ke 1 jika tidak ada dalam request
            $stok = $request->input('stok', 0);
        
            // Menghandle upload file foto
            $foto = $request->file('foto');
            $foto->storeAs('public/foto_barang', $foto->hashName());
            
        
            // Insert data ke tabel 'barang'
            DB::table('barang')->insert([
                'merk' => $request->merk,
                'seri' => $request->seri,
                'spesifikasi' => $request->spesifikasi,
                'stok' => $stok,
                'kategori_id' => $request->kategori_id,
                'foto'             => $foto->hashName()
            ]);
        
            // Menyimpan perubahan ke database
            DB::commit();
        
            return redirect()->route('barang.index')->with(['success' => 'Data berhasil disimpan.']);
        } catch (\Exception $e) {
            // Melaporkan kesalahan
            report($e);
        
            // Mengembalikan transaksi jika terjadi kesalahan
            DB::rollBack();
        
            return redirect()->route('barang.index')->with(['Gagal' => 'Terjadi kesalahan. Data tidak berhasil disimpan.']);
        }
        //return $request;
        //validate form


        // $this->validate($request, [
        //     'merk'          => 'required',
        //     'seri'          => 'required',
        //     'spesifikasi'   => 'required',
        //     'kategori_id'   => 'required|not_in:blank',
        //     'foto'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        // ]);
        
        // $existingBarang = Barang::where('merk', $request->merk)
        //                     ->where('seri', $request->seri)
        //                     ->where('spesifikasi', $request->spesifikasi)
        //                     ->first();

        // if ($existingBarang) {
        //     /
        //     return redirect()->back()->withErrors(['error' => 'Barang dengan merk, seri, dan spesifikasi yang sama sudah ada.']);
        // }

      
        // $foto = $request->file('foto');
        // $foto->storeAs('public/foto_barang', $foto->hashName());

        // Barang::create([
        //     'merk'             => $request->merk,
        //     'seri'             => $request->seri,
        //     'spesifikasi'      => $request->spesifikasi,
        //     'kategori_id'      => $request->kategori_id,
        //     'foto'             => $foto->hashName()
        // ]);

        
        // return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetBarang = Barang::find($id);

        //return $rsetBarang;

        //return view
        return view('barang.show', compact('rsetBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $akategori = Kategori::all();
    $rsetBarang = Barang::find($id);
    $selectedKategori = Kategori::find($rsetBarang->kategori_id);

    return view('barang.edit', compact('rsetBarang', 'akategori', 'selectedKategori'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'merk'        => 'required',
            'seri'        => 'required',
            'spesifikasi' => 'required',
            // 'stok'        => 'required',
            'kategori_id' => 'required|not_in:blank',
            'foto'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $rsetBarang = Barang::find($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {

            //upload new image
            $foto = $request->file('foto');
            $foto->storeAs('public/foto_barang', $foto->hashName());

            //delete old image
            Storage::delete('public/foto_barang/'.$rsetBarang->foto);

            //update post with new image
            $rsetBarang->update([
                'merk'          => $request->merk,
                'seri'          => $request->seri,
                'spesifikasi'   => $request->spesifikasi,
                // 'stok'          => $request->stok,
                'kategori_id'   => $request->kategori_id,
                'foto'          => $foto->hashName()
            ]);

        } else {

            //update post without image
            $rsetBarang->update([
                'merk'          => $request->merk,
                'seri'          => $request->seri,
                'spesifikasi'   => $request->spesifikasi,
                // 'stok'          => $request->stok,
                'kategori_id'   => $request->kategori_id,
            ]);
        }

        // Redirect to the index page with a success message
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(string $id)
    {
        if (DB::table('barangmasuk')->where('barang_id', $id)->exists()) {
            return redirect()->route('barang.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        }
        elseif (DB::table('barangkeluar')->where('barang_id', $id)->exists()) {
            return redirect()->route('barang.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        }
        else {
            $rsetBarang = Barang::find($id);
            $rsetBarang->delete();
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }

}
