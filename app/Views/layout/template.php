<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemesanan Tiket Pesawat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&display=swap');

        body {
            font-family: "Dosis", sans-serif;
        }

        .navbar,
        .navbar.bg-body-tertiary {
            background-color: black !important;
        }

        .dropdown-menu {
            background-color: #333;
            /* Warna latar dropdown */
            border: none;
        }

        .dropdown-item {
            color: #ffffff;
            /* Warna teks item dropdown */
        }

        .dropdown-item:hover {
            background-color: #575757;
            /* Warna latar saat hover */
        }

        .btn-outline-secondary {
            background-color: black;
            color: #ffffff;
        }

        .btn-outline-secondary a.nav-link {
            color: inherit;
            text-decoration: none;
        }

        .navbar-nav .nav-item .nav-link {
            color: white !important;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Tiket Pesawat</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <form class="conteinter-fluid">
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-outline-light me-2" aria-current="page" href="<?= base_url(''); ?>">Home</a>
                            <!-- <a class="btn btn-outline-light me-2" aria-current="page" href="<?= base_url('admin'); ?>">Halaman Admin</a> -->
                            <a class="btn btn-outline-light me-2" href="<?= base_url('wisata'); ?>">Pemesanan Tiket</a>
                            <?php if (session()->get('logged_in') != true) { ?>
                                <a class="btn btn-outline-light me-2" href="<?= base_url('login'); ?>">Login</a>
                            <?php } else { ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Hello, <?= session()->get('nama'); ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="<?= base_url('login/keluar'); ?>">Logout</a></li>
                                        <li><a class="dropdown-item" href="<?= base_url('riwayat'); ?>">Riwayat</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content'); ?>

    <div class="container py-3">
        <div class="row">
            <div class="col-md-12 mb-5">
                <?= $this->renderSection('content'); ?>
            </div>
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-md-40 bg-dark text-white py-2">
                        <p class="text-center my-auto">2024 &copy; Tiket Pesawat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>