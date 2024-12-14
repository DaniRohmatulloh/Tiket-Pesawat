<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mt-5 p-4 bg-light shadow-sm rounded" style="max-width: 600px;">
    <h3 class="text-center mb-4 text-primary">Tambah Tiket Pesawat</h3>

    <form action="<?= base_url('admin/Wisata/save'); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger text-center">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Asal Kota -->
        <div class="mb-4 position-relative">
            <label for="asal" class="form-label fw-semibold">Asal</label>
            <input type="text" name="asal" id="asal" class="form-control border rounded-pill px-4 py-2" placeholder="Contoh: Jakarta (JKTA)" value="<?= set_value('asal'); ?>">
            <small class="text-danger"><?= isset($validation) ? $validation->getError('asal') : ''; ?></small>
        </div>

        <!-- Kota Tujuan -->
        <div class="mb-4 position-relative">
            <label for="nama_wisata" class="form-label fw-semibold">Tujuan</label>
            <input type="text" name="nama_wisata" id="nama_wisata" class="form-control border rounded-pill px-4 py-2" placeholder="Contoh: Bali / Denpasar (DPS)" value="<?= set_value('nama_wisata'); ?>">
            <small class="text-danger"><?= isset($validation) ? $validation->getError('nama_wisata') : ''; ?></small>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4 position-relative">
            <label for="des" class="form-label fw-semibold">Deskripsi</label>
            <input type="text" name="des" id="des" class="form-control border rounded-pill px-4 py-2" placeholder="Masukkan Deskripsi" value="<?= set_value('des'); ?>">
            <small class="text-danger"><?= isset($validation) ? $validation->getError('des') : ''; ?></small>
        </div>

        <!-- Jumlah Kursi -->
        <div class="row mb-4">
            <div class="col">
                <label for="jumlah_kursi" class="form-label fw-semibold">Jumlah Kursi</label>
                <input type="number" name="jumlah_kursi" id="jumlah_kursi" class="form-control border rounded-pill px-4 py-2" value="<?= set_value('jumlah_kursi', 1); ?>" min="1">
                <small class="text-danger"><?= isset($validation) ? $validation->getError('jumlah_kursi') : ''; ?></small>
            </div>
        </div>

        <!-- Harga Tiket -->
        <div class="mb-4 position-relative">
            <label for="harga" class="form-label fw-semibold">Harga Tiket</label>
            <input type="number" name="harga" id="harga" class="form-control border rounded-pill px-4 py-2" placeholder="Masukkan harga tiket" value="<?= set_value('harga'); ?>">
            <small class="text-danger"><?= isset($validation) ? $validation->getError('harga') : ''; ?></small>
        </div>

        <!-- Foto -->
        <div class="mb-4 position-relative">
            <label for="foto" class="form-label fw-semibold">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control border rounded-pill px-4 py-2" accept="image/*">
            <small class="text-danger"><?= isset($validation) ? $validation->getError('foto') : ''; ?></small>
        </div>

        <!-- Tombol Submit -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg fw-semibold text-uppercase rounded-pill shadow-sm py-2">
                <i class="fas fa-ticket-alt me-2"></i> Tambah Tiket
            </button>
        </div>
    </form>
</div>

<!-- Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<?= $this->endSection(); ?>