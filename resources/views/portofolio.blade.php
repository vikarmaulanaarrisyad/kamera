<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lensyou Fotografi</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
         <style>
        .card-img-top {
            height: 200px; /* Set the desired height */
            object-fit: cover; /* Ensure the image covers the entire space */
        }
         .card-img-top:hover {
            cursor: zoom-in; /* Change cursor to zoom in on hover */
        }
    </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <i class="fas fa-home mr-2"></i>
                </a>
                <div class="mx-auto">
                    <span class="navbar-brand mb-0 h1">Lensyou Fotografi</span>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <div class="row">
                 @for ($i = 1; $i <= 18; $i++)
                <div class="col-6 mb-4">
                    <div class="card">
                        <a href="{{ asset('images/portofolio/'.$i.'.jpeg') }}" target="_blank">
                            <img src="{{ asset('images/portofolio/'.$i.'.jpeg') }}" class="img-thumbnail img-fluid" alt="Portfolio Image">
                        </a>
                        <div class="card-body">   
                            @if($i >= 1 && $i <= 8)
                                <span class="badge bg-info">Prewedding Outdoor</span>
                            @elseif($i > 8 && $i <= 10)
                                <span class="badge bg-success">Prewedding Indoor</span>
                            @else
                                <span class="badge bg-primary">Wedding</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endfor
               
            </div>
        </div>

        <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">&copy; <?php echo date('Y'); ?> Lensyou Fotografi</p></div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
