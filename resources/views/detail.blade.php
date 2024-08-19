<html>
    <head>
        <title>Detail - {{ $detail->nama_alat }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="stylesheet" href="/js/fullcalendar/main.css">
        <script src="/js/fullcalendar/main.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 col-lg-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header">
                            @if (Auth::guest())
                                <i class="fas fa-arrow-left"></i> <a href="{{ route('home') }}" class="link-dark">Kembali</a>
                            @elseif (Auth::user()->role == 0)
                                <i class="fas fa-arrow-left"></i> <a href="{{ route('member.index') }}" class="link-dark">Kembali</a>
                            @elseif (Auth::user()->role != 0)
                                <i class="fas fa-arrow-left"></i> <a href="{{ url()->previous() }}" class="link-dark">Kembali</a>
                            @endif
                        </div>
                        <img class="card-img-top" src="{{ url('') }}/images/{{ $detail->gambar }}" alt="" style="max-height: 400px">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">@money( $detail->paket4 )<span class="badge bg-light text-dark" style="float: right;">Paket 4</span></li>
                            <li class="list-group-item">@money( $detail->paket3 )<span class="badge bg-light text-dark" style="float: right;">Paket 3</span></li>
                            <li class="list-group-item">@money( $detail->paket2 )<span class="badge bg-light text-dark" style="float: right;">Paket 2</span></li>
                            <li class="list-group-item">@money( $detail->paket1 )<span class="badge bg-light text-dark" style="float: right;">Paket 1</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 mb-4">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h4><span class="badge bg-warning">{{ $detail->category->nama_kategori }}</span></h4>
                            <h1><b>{{ $detail->nama_alat }}</b></h1>
                          <pre class="text-muted">{{ $detail->deskripsi }}</pre>

                            @if (Auth::check() && Auth::user()->role == 0)
                            <form action="{{ route('cart.store',['id' => $detail->id, 'userId' => Auth::user()->id]) }}" method="POST">
                                @csrf
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-success mx-2" name="btn" value="4"><i class="fas fa-shopping-cart"></i> @money($detail->paket4) <b>Paket 4</b></button>
                                    <button type="submit" class="btn btn-success mx-2" name="btn" value="3"><i class="fas fa-shopping-cart"></i> @money($detail->paket3) <b>Paket 3</b></button>
                                    <button type="submit" class="btn btn-success mx-2" name="btn" value="2"><i class="fas fa-shopping-cart"></i> @money($detail->paket2) <b>Paket 2</b></button>
                                    <button type="submit" class="btn btn-success mx-2" name="btn" value="1"><i class="fas fa-shopping-cart"></i> @money($detail->paket1) <b>Paket 1</b></button>
                                </div>
                            </form>
                            <p class="text-muted">Anda sedang login sebagai <b>{{ Auth::user()->name }}</b></p>
                            @endif
                            <hr>
                            <h6><i>Daftar Reservasi Mendatang</i></h6>
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $item)
                                    <tr>
                                        @if ($item->payment->status == 3)
                                        <td>{{ date('d M Y H:i', strtotime($item->starts)) }} <span class="badge bg-secondary">{{ $item->durasi }} Jam</span></td>
                                        <td>{{ date('d M Y H:i', strtotime($item->ends)) }}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var endpoint = "/api/kalender-alat/";
            var param = {!! $detail->id !!};
            var withParam = endpoint+param;
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 500,
                    selectable: true,
                    navLinks: true,
                    eventSources: [
                        {
                            url: withParam,
                            color: 'yellow',
                            textColor: 'black'
                        }
                    ],
                    eventTimeFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: false
                    },
                    headerToolbar: {
                        left: 'dayGridMonth,timeGridDay',
                        center: 'title',
                    }
                });
                calendar.render();
            });
        </script>
    </body>
</html>
