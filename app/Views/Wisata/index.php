<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<?php
function buatRp($angka)
{
    return "Rp" . number_format($angka, 2, ',', '.');
}
?>
<div class="container my-5">
    <h1 class="text-center mb-5 text-primary fw-bold fs-2">Kelola Tiket Pesawat</h1> <!-- Increased font size -->

    <!-- Display Flash Messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success text-center rounded-pill py-3 px-4 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger text-center rounded-pill py-3 px-4 shadow-sm">
            <i class="bi bi-exclamation-circle-fill me-2"></i><?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-hover table-striped text-center">
            <thead class="table-primary">
                <tr>
                    <th scope="col" class="fs-5">No.</th>
                    <th scope="col" class="fs-5">Asal</th>
                    <th scope="col" class="fs-5">Tujuan</th>
                    <th scope="col" class="fs-5">Class</th>
                    <th scope="col" class="fs-5">jumlah kursi</th>
                    <th scope="col" class="fs-5">Harga</th>
                    <th scope="col" class="fs-5">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($wisata as $data): ?>
                    <tr>
                        <th scope="row" class="fs-6"><?= $no; ?></th>
                        <td scope="col" class="fs-5" style="width: 50px;"><?= esc($data->asal); ?></td>
                        <td scope="col" class="fs-5" style="width: 50px;"><?= esc($data->nama_wisata); ?></td>
                        <td scope="col" class="fs-5" style="width: 50px;"><?= esc($data->class); ?></td>
                        <td scope="col" class="fs-5" style="width: 50px;"><?= esc($data->jumlah_kursi); ?></td>
                        <td scope="col" class="fs-5" style="width: 50px;"><?= buatRp($data->harga); ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?= base_url('admin/Wisata/edit/' . $data->id_wisata); ?>" class="btn btn-outline-primary btn-sm shadow-sm">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/Wisata/delete/' . $data->id_wisata); ?>" class="btn btn-outline-danger btn-sm shadow-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="<?= base_url('admin/Wisata/add'); ?>" class="btn btn-primary btn-lg rounded-pill d-flex align-items-center gap-2 shadow-sm">
            <i class="fas fa-plus-circle me-2 fs-5"></i>
            <strong>Tambah Tiket</strong>
        </a>
    </div>
</div>

<!-- Link to Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome and Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<?= $this->endSection(); ?>