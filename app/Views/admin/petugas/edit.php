<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mt-3">
    <h3 class="text-center mb-3">Ubah Data Admin</h3>

    <form action="<?= base_url('admin/petugas/update'); ?>" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="kode" value="<?= $cari->id_admin; ?>">
        <?php $validation = \Config\Services::validation(); ?>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= $cari->nama; ?>">
            <small class="text-center text-danger"><?= $validation->getError('nama'); ?></small>
        </div>

        <div class="mb-3">
            <label for="des" class="form-label">email</label>
            <input type="text" name="email" class="form-control" value="<?= $cari->email; ?>"></input>
            <small class="text-center text-danger"><?= $validation->getError('email'); ?></small>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="<?= set_value('password'); ?>">
            <small class="text-center text-danger"><?= $validation->getError('password'); ?></small>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save"></i> Save
            </button>
        </div>
    </form>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<?= $this->endSection(); ?>