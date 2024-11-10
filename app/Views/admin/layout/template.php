<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Tiket Pesawat</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="btn btn-outline-light me-2" href="<?= base_url('admin'); ?>">Home</a>
          <a class="btn btn-outline-light me-2" href="<?= base_url('admin/Wisata'); ?>">Daftar Tiket Pesawat</a>
          <a class="btn btn-outline-light me-2" href="<?= base_url('admin/petugas'); ?>">Admin</a>
          <a class="btn btn-outline-light" href="<?= base_url('admin/login/keluar'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container py-3">
    <div class="row">
      <div class="col-md-12 mb-5">
        <?= $this->renderSection('content'); ?>
      </div>
      <!-- <div class="col-md-4">
        <h5 class="mb-3">List Tiket Pesawat</h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">An item</li>
          <li class="list-group-item">A second item</li>
          <li class="list-group-item">A third item</li>
          <li class="list-group-item">A fourth item</li>
          <li class="list-group-item">And a fifth one</li>
        </ul>
      </div> -->
    </div>
  </div>

  <footer class="bg-dark text-white py-2">
    <div class="container text-center">
      <p class="mb-0">2024 &copy; Tiket Pesawat</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>