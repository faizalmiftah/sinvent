@extends('layout.adm-main')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
<body>
    <div class="container">
        <center>
        <h2>Selamat Datang di Aplikasi Inventori Barang</h2>
        </center>
    </div>
    <div class="dashboard">
        <div id="product" class="p-5">
            <h5>Silahkan Pilih Menu</h5>
            <br>
            <div class="card-group">
                <div class="card" style="width: 10rem;">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.Ssqm17pSdPX2R0UI-MdFqQHaEU&pid=Api&P=0&h=180" class="card-img-top" alt="..."/>
                    <div class="card-body">
                        <h5 class="card-title">Kategori</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="kategori" class="btn btn-primary">Daftar Kategori</a>
                    </div>
                </div>
                <div class="card" style="width: 10rem;">
                    <img src="https://tse3.mm.bing.net/th?id=OIP.iJDH7xt-9RDmRmqQQJsDPgHaEK&pid=Api&P=0&h=180" class="card-img-top" alt="..."/>
                    <div class="card-body">
                        <h5 class="card-title">Barang</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="barang" class="btn btn-primary">Daftar Barang</a>
                    </div>
                </div>
                <div class="card" style="width: 10rem;">
                    <img src="https://e7.pngegg.com/pngimages/654/80/png-clipart-warehouse-computer-icons-cargo-warehouse-miscellaneous-text.png" class="card-img-top" alt="..."/>
                    <div class="card-body">
                        <h5 class="card-title">Barang Masuk</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="barangmasuk" class="btn btn-primary">Daftar Barang Masuk</a>
                    </div>
                </div>
                <div class="card" style="width: 10rem;">
                    <img src="https://e7.pngegg.com/pngimages/896/837/png-clipart-computer-icons-parcel-icon-others-angle-freight-transport.png" class="card-img-top" alt="..."/>
                    <div class="card-body">
                        <h5 class="card-title">Barang Keluar</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="barangkeluar" class="btn btn-primary">Daftar Barang Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
@endsection