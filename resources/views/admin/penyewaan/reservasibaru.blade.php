<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Reservasi Baru</title>
</head>

<body>
    <div class="container-fluid px-4">
        <div class="row mt-4">
            <div class="col-12"><a href="{{ route('admin.user') }}" class="btn btn-primary">Kembali</a></div>
        </div>
        <div class="row mb-4 mt-2">
            <div class="col-12">
                <h4>Buat Reservasi untuk <b>{{ $user->name }}</b></h4>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8 col-sm-12">
                <div class="card shadow h-100" style="max-height: 500px; overflow:auto">
                    <div class="card-header"><small class="text-muted">klik nama untuk melihat detail</small></div>
                    <div class="card-body">
                        {{-- <div class="row row-cols-sm-2 row-cols-lg-4 g-2">
                             --}}
                        <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-3 g-2">

                            @foreach ($alat as $item)
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="{{ url('') }}/images/{{ $item->gambar }}" style="height: 400px;"
                                            alt="">
                                        <div class="card-body">
                                            <span
                                                class="badge bg-warning">{{ $item->category->nama_kategori }}</span><br>
                                            <b><a class="link-dark"
                                                    href="{{ route('home.detail', ['id' => $item->id]) }}">{{ $item->nama_alat }}</b></a><br>
                                            <small>{{ $item->deskripsi }}</small>
                                        </div>
                                        <div class="card-footer">
                                            <form
                                                action="{{ route('cart.store', ['id' => $item->id, 'userId' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="d-block">
                                                    <button type="submit" class="btn btn-success w-100 mt-2"
                                                        name="btn" value="4"><i
                                                            class="fas fa-shopping-cart"></i> @money($item->paket4)
                                                        <b>Paket 4</b></button>
                                                    <button type="submit" class="btn btn-success w-100 mt-2"
                                                        name="btn" value="3"><i
                                                            class="fas fa-shopping-cart"></i> @money($item->paket3)
                                                        <b>Paket 3</b></button>
                                                    <button type="submit" class="btn btn-success w-100 mt-2"
                                                        name="btn" value="2"><i
                                                            class="fas fa-shopping-cart"></i> @money($item->paket2)
                                                        <b>Paket 2</b></button>
                                                    <button type="submit" class="btn btn-success w-100 mt-2"
                                                        name="btn" value="1"><i
                                                            class="fas fa-shopping-cart"></i> @money($item->paket1)
                                                        <b>Paket 1</b></button>
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
                        <b>Keranjang</b> <span class="badge bg-secondary">{{ $user->cart->count() }}</span>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="list-group">
                                @foreach ($cart as $item)
                                    <div class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">{{ $item->alat->nama_alat }}</h6>
                                            <b>@money($item->harga)</b>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <p class="mb-1">Paket {{ $item->paket }}</p>
                                            <form action="{{ route('cart.destroy', ['id' => $item->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button style="background: none" type="submit"><i class="fas fa-trash"
                                                        style="color: gray"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex w-100 justify-content-between mb-2">
                            <b>Total</b>
                            <b>@money($total)</b>
                        </div>
                        <small>Tanggal Booking</small>
                        <form action="{{ route('admin.createorder', ['userId' => $user->id]) }}" method="POST">
                            @csrf
                            <div class="d-flex w-100 justify-content-center mb-4">
                                <div class="w-50 pe-2">
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>
                                <div class="w-50 ps-2">
                                    <input type="time" name="start_time" class="form-control" required>
                                </div>
                            </div>

                            <button type="submit" style="width:100%" class="btn btn-success">Checkout</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
