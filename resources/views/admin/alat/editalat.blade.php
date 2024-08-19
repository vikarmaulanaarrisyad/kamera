@extends('admin.main')
@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="row mt-4">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <a class="link-dark" href="{{ route('alat.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a> | Detail untuk Produk "{{ $alat->nama_alat }}"
                    </div>
                    <div class="card-body">
                        <form action="{{ route('alat.update',['id' => $alat->id]) }}" method="POST" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <input class="form-control form-control-lg mb-4" type="text" name="nama" value="{{ $alat->nama_alat }}" required>
                            <select name="kategori" class="form-select mb-4">
                                @foreach ($kategori as $cat)
                                <option value="{{ $cat->id }}"
                                    @if ($cat->id == $alat->category->id)
                                        selected="selected"
                                    @endif>{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <textarea class="form-control" name="deskripsi" placeholder="Deskripsi singkat" rows="3">{{ $alat->deskripsi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <span class="form-text mb-2">Harga ditulis angka saja, tidak perlu tanda titik</span>
                                <div class="row d-flex w-100 justify-content-start">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" value="{{ $alat->paket4 }}" name="paket4" class="form-control" placeholder="Harga Paket 4" required>
                                        <span class="input-group-text"><b>Paket 4</b></span>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" value="{{ $alat->paket3 }}" name="paket3" class="form-control" placeholder="Harga Paket 3" required>
                                        <span class="input-group-text"><b>Paket 3</b></span>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" value="{{ $alat->paket2 }}" name="paket2" class="form-control" placeholder="Harga Paket 2" required>
                                        <span class="input-group-text"><b>Paket 2</b></span>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" value="{{ $alat->paket1 }}" name="paket1" class="form-control" placeholder="Harga Paket 1" required>
                                        <span class="input-group-text"><b>Paket 1</b></span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="form-text">Upload Gambar</span>
                                    <input type="file" name="gambar" class="form-control">
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-4"><button class="btn btn-success" type="submit" style="float: right">Simpan Perubahan</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('alat.destroy',['id'=>$alat->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="alert alert-danger">
                                <b>Danger Zone: menghapus produk akan mempengaruhi transaksi yang telah dibuat</b>   <button class="btn btn-danger" onclick="javascript: return confirm('Anda yakin akan menghapus alat ini?');" type="submit">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
