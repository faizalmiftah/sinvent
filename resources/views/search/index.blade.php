
@extends('layout.adm-main')

@section('content')
<!-- <div class="container-fluid">
    <h1>Search Results for "{{ request('query') }}"</h1>
    
    <h2>Barangs</h2>
    @if($barangs->isEmpty())
        <p>No barangs found.</p>
    @else
        <ul>
            @foreach($barangs as $barang)
                <li>{{ $barang->merk }} - {{ $barang->seri }} - {{ $barang->spesifikasi }} - {{ $barang->stok }}</li>
            @endforeach
        </ul>
    @endif
    
    <h2>Kategoris</h2>
    @if($kategoris->isEmpty())
        <p>No kategoris found.</p>
    @else
        <ul>
            @foreach($kategoris as $kategori)
                <li>{{ $kategori->deskripsi }} - {{ $kategori->ketkategori }} - {{ $kategori->kategori }}</li>
            @endforeach
        </ul>
    @endif
</div> -->


<div class="container-fluid">
    <h1>Search Results for "{{ request('query') }}"</h1>
    
    <h2>Barang</h2>
    @if($barangs->isEmpty())
        <p>No barangs found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>MERK</th>
                    <th>SERI</th>
                    <th>SPESIFIKASI</th>
                    <th>STOK</th>
                    <th>KATEGORI</th>
                    <th>FOTO</th>
                    <th style="width: 15%">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->merk }}</td>
                        <td>{{ $barang->seri }}</td>
                        <td>{{ $barang->spesifikasi }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>{{ $barang->kategori->kategori }}</td>
                        <td class="text-center">
                            <img src="{{ asset('storage/foto_barang/'.$barang->foto) }}" class="rounded" style="width: 150px">
                        </td>
                        <td class="text-center">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                                <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Kategori</h2>
    @if($kategoris->isEmpty())
        <p>No kategoris found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>DESKRIPSI</th>
                    <th>KATEGORI</th>
                    <th>Keterangan Kategori</th>
                    <th style="width: 15%">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $kategori)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kategori->deskripsi }}</td>
                        <td>{{ $kategori->kategori }}</td>
                        <td>{{ $kategori->ketkategori }}</td>
                        <td class="text-center">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                                <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
