@extends('member.main')
@section('container')
    <div class="row mb-2">
        <div class="col col-sm-12">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }} &nbsp; <a href="#keranjang">cek keranjang</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (request()->get('search') == null)
                <div class="d-flex w-100 justify-content-start mb-2" style="overflow: auto">
                    <div class="btn-group" role="group">
                        <a class="btn {{ request('kategori') == null ? 'btn-primary' : 'btn-outline-primary' }}"
                            href="{{ route('member.index') }}">Semua</a>
                        @foreach ($kategori as $cat)
                            <a class="btn {{ request('kategori') == $cat->id ? 'btn-primary' : 'btn-outline-primary' }}"
                                href="?kategori={{ $cat->id }}">{{ $cat->nama_kategori }}</a>
                        @endforeach
                    </div>
                </div>
            @else
                <p>Menampilkan hasil pencarian <b>{{ request()->get('search') }}</b>. <a class="link"
                        href="{{ route('member.index') }}">Kembali tampilkan semua.</a></p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col col-md-8 col-sm-12">
            <form action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" width="25%" placeholder="Cari" name="search"
                        {{ request()->get('search') != null ? 'value = ' . request()->get('search') . '' : '' }}>
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
            <div class="card shadow h-100">
                <div class="card-header"><small class="text-muted">klik nama untuk melihat detail</small></div>
                <div class="card-body" style="height: 500px; overflow:auto">
                    {{-- <div class="row row-cols-sm-2 row-cols-lg-4 g-2"> --}}
                    <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-3 g-2">

                        @foreach ($alat as $item)
                            <div class="col">
                                <div class="card h-100">
                                    <img class="card-img-top" src="{{ url('') }}/images/{{ $item->gambar }}"
                                        style="height: 100%;" alt="">
                                    <div class="card-body">
                                        <span class="badge bg-warning">{{ $item->category->nama_kategori }}</span><br>
                                        <b><a class="link-dark"
                                                href="{{ route('home.detail', ['id' => $item->id]) }}">{{ $item->nama_alat }}</b></a><br>
                                        <pre>{{ $item->deskripsi }}</pre><br>
                                        <hr>
                                        <div class="d-flex w-100 justify-content-between">
                                            <small class="mb-1"><b>@money($item->paket4)</b></small>
                                            <small><b>Paket 4</b></small>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <small class="mb-1"><b>@money($item->paket3)</b></small>
                                            <small><b>Paket 3</b></small>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <small class="mb-1"><b>@money($item->paket2)</b></small>
                                            <small><b>Paket 2</b></small>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <small class="mb-1"><b>@money($item->paket1)</b></small>
                                            <small><b>Paket 1</b></small>
                                        </div>
                                    </div>
                                    <div class="card-footer  mt-auto">
                                        <form
                                            action="{{ route('cart.store', ['id' => $item->id, 'userId' => Auth::user()->id]) }}"
                                            method="POST">
                                            @csrf
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="addtocartdropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="addtocartdropdown">
                                                    <li><button type="submit" class="dropdown-item" name="btn"
                                                            value="4"><i class="fas fa-shopping-cart"></i>
                                                            @money($item->paket4) <b>Paket 4</b></button></li>
                                                    <li><button type="submit" class="dropdown-item" name="btn"
                                                            value="3"><i class="fas fa-shopping-cart"></i>
                                                            @money($item->paket3) <b>Paket 3</b></button></li>
                                                    <li><button type="submit" class="dropdown-item" name="btn"
                                                            value="2"><i class="fas fa-shopping-cart"></i>
                                                            @money($item->paket2) <b>Paket 2</b></button></li>
                                                    <li><button type="submit" class="dropdown-item" name="btn"
                                                            value="1"><i class="fas fa-shopping-cart"></i>
                                                            @money($item->paket1) <b>Paket 1</b></button></li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-md-4 col-sm-12">
            <div class="card shadow" id="keranjang">
                <div class="card-header" id="keranjang">
                    <b>Keranjang</b> <span class="badge bg-secondary">{{ Auth::user()->cart->count() }}</span>
                </div>
                <div class="card-body">
                    <div>
                        <div class="list-group">
                            @forelse ($carts as $item)
                                <div class="list-group-item list-group-item-action" aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $item->alat->nama_alat }}</h6>
                                        <b>@money($item->harga)</b>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <p class="mb-1">Paket {{ $item->paket }}</p>
                                        <form action="{{ route('cart.destroy', ['id' => $item->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></a>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">Kamu belum menambahkan apapun kedalam keranjang</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex w-100 justify-content-between mb-2">
                        <b>Total</b>
                        <b>@money($total)</b>
                    </div>
                    <form action="{{ route('order.create') }}" method="POST">
                        @csrf
                        <small>Tanggal Booking</small>
                        <input type="date" name="start_date" class="form-control mb-2" required>
                        <small>Jam Booking</small>
                        <input type="time" name="start_time" class="form-control mb-3" required>
                        <button type="submit" style="width:100%" class="btn btn-success"
                            {{ Auth::user()->cart->count() == 0 ? 'disabled' : '' }}>Checkout</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
