<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h3 class="text-center">Halaman Kelola Admin</h3>
    <h2 class="mb-4">Daftar Admin</h2>

    <div class="table-responsive">
        <table class="table table-hover">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Proses</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($petugas as $data): ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td><?= htmlspecialchars($data->nama); ?></td>
                        <td><?= htmlspecialchars($data->email); ?></td>
                        <td>

                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?= base_url('admin/petugas/edit/' . $data->id_admin); ?>" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Edit Admin">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/petugas/delete/' . $data->id_admin); ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" data-bs-toggle="tooltip" title="Hapus Admin">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="d-grid">
        <a href="<?= base_url('admin/petugas/add'); ?>" class="btn btn-primary btn-lg">Tambah Admin</a>
    </div>
</div>
<?= $this->endSection(); ?>