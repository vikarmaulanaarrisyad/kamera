@extends('admin.main')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Produk</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Manajemen Produk</li>
        </ol>
        <div class="row">
            @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="col-lg">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        Produk
                    </div>
                    <div class="card-body">
                        <a type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahAlat">Tambah Produk</a>
                        <div class="dropdown" style="float: right;">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                              Filter Kategori
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('alat.index') }}">Semua</a></li>
                                @foreach ($categories as $cat)
                                <li><a class="dropdown-item" href="{{ route('alat.index',['id'=>$cat->id]) }}">{{ $cat->nama_kategori }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <form action="">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" width="25%" placeholder="Cari Produk" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body" style="max-height: 500px; overflow:scroll;">
                        <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-3 g-2">
                            @foreach ($alats as $alat)
                            <div class="col">
                                <div class="card h-100">
                                    <img class="card-img-top" src="{{ url('') }}/images/{{ $alat->gambar }}" alt="" style="max-height: 400px">
                                    <div class="card-body">
                                        <span class="badge bg-warning">{{ $alat->category->nama_kategori }}</span>
                                        <h6 class="card-title">{{ $alat->nama_alat }}</h6>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">@money($alat->paket4)<span class="badge bg-light text-dark" style="float: right;">Paket 4</span></li>
                                        <li class="list-group-item">@money($alat->paket3)<span class="badge bg-light text-dark" style="float: right;">paket 3</span></li>
                                        <li class="list-group-item">@money($alat->paket2)<span class="badge bg-light text-dark" style="float: right;">Paket 2</span></li>
                                        <li class="list-group-item">@money($alat->paket1)<span class="badge bg-light text-dark" style="float: right;">Paket 1</span></li>
                                    </ul>
                                    <div class="card-footer">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('alat.edit',['id' => $alat->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="tambahAlat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Produk" required>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="kategori" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi singkat"></textarea>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <span class="form-text mb-2">Harga ditulis angka saja, tidak perlu tanda titik</span>
                        <div class="col col-3"><input type="number" name="paket1" class="form-control" placeholder="Harga Paket 1" required></div>
                        <div class="col col-3"><input type="number" name="paket2" class="form-control" placeholder="Harga Paket 2" required></div>
                        <div class="col col-3"><input type="number" name="paket3" class="form-control" placeholder="Harga Paket 3" required></div>
                        <div class="col col-3"><input type="number" name="paket4" class="form-control" placeholder="Harga Paket 4" required></div>
                    </div>
                </div>
                <div class="mb-3">
                    <span class="form-text">Upload Gambar</span>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
