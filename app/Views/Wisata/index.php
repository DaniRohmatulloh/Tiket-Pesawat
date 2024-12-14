<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<?php
function buatRp($angka)
{
    return "Rp" . number_format($angka, 2, ',', '.');
}
?>
<div class="container my-5">
    <h1 class="text-center mb-5 text-primary fw-bold fs-2">Kelola Tiket Pesawat</h1>

    <!-- Form Pencarian -->
    <form action="" method="get" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Asal atau Tujuan..." value="<?= esc($search ?? '') ?>">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </div>
    </form>

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
                    <th scope="col" class="fs-5">Foto</th>
                    <th scope="col" class="fs-5">Asal</th>
                    <th scope="col" class="fs-5">Tujuan</th>
                    <th scope="col" class="fs-5">Jumlah Kursi</th>
                    <th scope="col" class="fs-5">Harga</th>
                    <th scope="col" class="fs-5">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($wisata) > 0): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($wisata as $data): ?>
                        <tr>
                            <th scope="row" class="fs-6"><?= $no; ?></th>
                            <td scope="col">
                                <img src="<?= base_url('foto/' . $data->foto); ?>" alt="Foto Tiket" width="100" height="70" class="rounded">
                            </td>
                            <td scope="col" class="fs-5"><?= esc($data->asal); ?></td>
                            <td scope="col" class="fs-5"><?= esc($data->nama_wisata); ?></td>
                            <td scope="col" class="fs-5"><?= esc($data->jumlah_kursi); ?></td>
                            <td scope="col" class="fs-5"><?= buatRp($data->harga); ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('admin/Wisata/edit/' . $data->id_wisata); ?>" class="btn btn-outline-primary btn-sm shadow-sm">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $data->id_wisata; ?>">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php $no++; ?>

                        <!-- Modal Delete Confirmation -->
                        <div class="modal fade" id="deleteModal<?= $data->id_wisata; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="deleteModalLabel"><i class="bi bi-trash-fill"></i> Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center">
                                            <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>
                                        </div>
                                        <p class="mt-3 text-center">Apakah Anda yakin ingin menghapus tiket pesawat ini?</p>
                                        <div class="alert alert-warning text-center">
                                            <small>
                                                <i class="bi bi-info-circle-fill me-1"></i>
                                                Data yang sudah dihapus tidak dapat dikembalikan.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <a href="<?= base_url('admin/Wisata/delete/' . $data->id_wisata); ?>" class="btn btn-danger">
                                            <i class="bi bi-trash-fill"></i> Ya, Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
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