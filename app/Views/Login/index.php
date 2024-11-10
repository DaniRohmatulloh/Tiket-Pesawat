<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light bg-gradient">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary">Login User</h3>
                            <p class="text-muted">Please enter your login details</p>
                            <?php
                            if (session()->getFlashdata('success')) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                            <?php
                            }
                            if (session()->getFlashdata('error')) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashdata('error'); ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php $validation = \Config\Services::validation(); ?>
                        <form action="<?= base_url('login/proses'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" value="<?= set_value('email'); ?>" id="email" placeholder="Email">
                                <label for="email"><i class="bi bi-envelope-fill"></i> Email</label>
                                <small class="text-center text-danger"><?= $validation->getError('email'); ?>
                                </small>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" value="<?= set_value('password'); ?>" id="password" placeholder="Password">
                                <label for="password"><i class="bi bi-lock-fill"></i> Password</label>
                                <small class="text-center text-danger"><?= $validation->getError('password'); ?>
                                </small>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Login</button>
                                <a href="<?= base_url('login/register'); ?>" class="btn btn-outline-secondary btn-lg">Register Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>