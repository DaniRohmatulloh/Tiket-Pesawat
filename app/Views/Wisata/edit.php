<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mt-5 p-4 bg-light shadow-sm rounded" style="max-width: 600px;">
    <h3 class="text-center mb-4 text-primary">Ubah Data Tiket Pesawat</h3>

    <form action="<?= base_url('admin/Wisata/update'); ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="kode" value="<?= $cari->id_wisata; ?>">

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger text-center">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php $validation = \Config\Services::validation(); ?>
        <!-- Asal -->
        <div class="mb-4 position-relative">
            <label for="asal" class="form-label fw-semibold">Asal</label>
            <input type="text" name="asal" id="asal" class="form-control border rounded-pill px-4 py-2" value="<?= esc($cari->asal); ?>" placeholder="Masukkan asal">
            <small class="text-danger"><?= $validation->getError('asal'); ?></small>
        </div>

        <!-- Nama Kota -->
        <div class="mb-4 position-relative">
            <label for="nama" class="form-label fw-semibold">Tujuan</label>
            <input type="text" name="nama_wisata" id="nama_wisata" class="form-control border rounded-pill px-4 py-2" value="<?= esc($cari->nama_wisata); ?>" placeholder="Masukkan nama Kota">
            <small class="text-danger"><?= $validation->getError('nama_wisata'); ?></small>
        </div>
        <!-- Deskripsi -->
        <div class="mb-4 position-relative">
            <label for="des" class="form-label fw-semibold">Deskripsi</label>
            <textarea name="des" id="des" class="form-control border rounded-pill px-4 py-2" rows="3" placeholder="Masukkan deskripsi"><?= esc($cari->deskripsi); ?></textarea>
            <small class="text-danger"><?= $validation->getError('des'); ?></small>
        </div>



        <!-- Harga Tiket Pesawat -->
        <div class="mb-4 position-relative">
            <label for="harga" class="form-label fw-semibold">Harga Tiket Pesawat</label>
            <input type="number" name="harga" id="harga" class="form-control border rounded-pill px-4 py-2" value="<?= esc($cari->harga); ?>" placeholder="Masukkan harga tiket">
            <small class="text-danger"><?= $validation->getError('harga'); ?></small>
        </div>

        <!-- Kelas and Penumpang Combined -->
        <div class="row mb-4">
            <div class="col">
                <label for="jumlah_kursi" class="form-label fw-semibold">Jumlah Kursi</label>
                <input type="number" name="jumlah_kursi" id="jumlah_kursi" class="form-control border rounded-pill px-4 py-2" value="<?= esc($cari->jumlah_kursi); ?>" min="1">
                <small class="text-danger"><?= $validation->getError('jumlah_kursi'); ?></small>
            </div>
        </div>

        <!-- Input Foto -->
        <div class="mb-4 position-relative">
            <label for="foto" class="form-label fw-semibold">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control border rounded-pill px-4 py-2" accept="image/*">
            <small class="text-danger"><?= $validation->getError('foto'); ?></small>
        </div>

        <!-- Tombol Submit -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg fw-semibold text-uppercase rounded-pill shadow-sm py-2">
                <i class="fas fa-save me-2"></i> Simpan
            </button>
        </div>
    </form>
</div>

<!-- Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<?= $this->endSection(); ?>