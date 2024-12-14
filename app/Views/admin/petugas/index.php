<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container py-4">
    <!-- Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0">Kelola Admin</h3>
                <small>Panel Manajemen Administrator</small>
            </div>
            <i class="bi bi-people-fill fs-3"></i>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Administrator</h5>
            <a href="<?= base_url('admin/petugas/add'); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill me-1"></i>Tambah Admin
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama</th>
                            <th width="25%">Email</th>
                            <th width="15%">Status</th>
                            <th width="30%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($petugas as $data): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 35px; height: 35px;">
                                            <?= strtoupper(substr($data->nama, 0, 2)); ?>
                                        </div>
                                        <?= htmlspecialchars($data->nama); ?>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($data->email); ?></td>
                                <td>
                                    <span class="badge bg-success">Aktif</span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-info"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detailModal<?= $data->id_admin; ?>">
                                            <i class="bi bi-eye-fill me-1"></i>Detail
                                        </button>
                                        <a href="<?= base_url('admin/petugas/edit/' . $data->id_admin); ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil-fill me-1"></i>Edit
                                        </a>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal<?= $data->id_admin; ?>">
                                            <i class="bi bi-trash-fill me-1"></i>Hapus
                                        </button>
                                    </div>

                                    <!-- Detail Modal -->
                                    <div class="modal fade" id="detailModal<?= $data->id_admin; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">Detail Administrator</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center mb-4">
                                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                                            style="width: 80px; height: 80px; font-size: 1.5rem;">
                                                            <?= strtoupper(substr($data->nama, 0, 2)); ?>
                                                        </div>
                                                        <h5 class="mb-1"><?= htmlspecialchars($data->nama); ?></h5>
                                                        <p class="text-muted mb-0">Administrator</p>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-6">
                                                            <div class="p-3 bg-light rounded">
                                                                <small class="text-muted d-block">ID Admin</small>
                                                                <span class="fw-medium">#<?= $data->id_admin ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="p-3 bg-light rounded">
                                                                <small class="text-muted d-block">Status</small>
                                                                <span class="text-success fw-medium">Aktif</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="p-3 bg-light rounded">
                                                                <small class="text-muted d-block">Email</small>
                                                                <span class="fw-medium"><?= htmlspecialchars($data->email); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal<?= $data->id_admin; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <i class="bi bi-exclamation-triangle-fill text-danger fs-1 mb-3"></i>
                                                    <p>Hapus administrator <strong><?= htmlspecialchars($data->nama); ?></strong>?</p>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                    <a href="<?= base_url('admin/petugas/delete/' . $data->id_admin); ?>"
                                                        class="btn btn-danger">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($petugas)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="bi bi-people-fill text-muted fs-1 mb-2"></i>
                                    <p class="mb-0">Belum ada data administrator</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 0.5rem;
        border: none;
    }

    .modal-content {
        border-radius: 0.5rem;
        border: none;
    }

    .table td,
    .table th {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
    }

    .badge {
        padding: 0.5em 0.8em;
    }

    .modal-dialog-centered {
        max-width: 400px;
    }

    .rounded {
        border-radius: 0.5rem !important;
    }
</style>
<?= $this->endSection(); ?>