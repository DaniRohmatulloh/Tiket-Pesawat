<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4e73df, #1cc88a);
        }
    </style>
</head>

<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded">
                <div class="card-body">
                    <h3 class="text-center mb-4 text-dark">Login Admin</h3> <!-- Teks judul diubah menjadi hitam -->
                    <p class="text-center"><i class="fas fa-user-lock fa-3x text-black"></i></p>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/login/cek'); ?>" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label text-dark">Email</label> <!-- Label diubah menjadi hitam -->
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" value="<?= set_value('email'); ?>">
                            </div>
                            <small class="text-danger"><?= \Config\Services::validation()->getError('email'); ?></small>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-dark">Password</label> <!-- Label diubah menjadi hitam -->
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password">
                            </div>
                            <small class="text-danger"><?= \Config\Services::validation()->getError('password'); ?></small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
                <div class="text-center mt-3">
                    <p class="mb-0 text-dark">© <?= date("Y"); ?> Your Company Name</p> <!-- Teks copyright diubah menjadi hitam -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>