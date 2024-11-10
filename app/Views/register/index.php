<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Register New Account</h3>
                            <?php $validation = \Config\Services::validation(); ?>
                        </div>
                        <form action="<?= base_url('login/save'); ?>" method="post" novalidate>
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?= set_value('nama'); ?>" id="nama" required>
                                <small class="text-center text-danger"><?= $validation->getError('nama'); ?></small>
                            </div>
                            <div class="mb-3">
                                <label for="kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="kelamin" class="form-select" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <small class="text-center text-danger"><?= $validation->getError('kelamin'); ?></small>
                            </div>
                            <div class="mb-3">
                                <label for="ponsel" class="form-label">Nomer Ponsel</label>
                                <input type="ponsel" name="ponsel" class="form-control" value="<?= set_value('ponsel'); ?>" id="ponsel">
                                <small class="text-center text-danger"><?= $validation->getError('ponsel'); ?></small>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= set_value('email'); ?>" id="email">
                                <small class="text-center text-danger"><?= $validation->getError('email'); ?></small>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" value="<?= set_value('password'); ?>" id="password" required>
                                <small class="text-center text-danger"><?= $validation->getError('password'); ?></small>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>