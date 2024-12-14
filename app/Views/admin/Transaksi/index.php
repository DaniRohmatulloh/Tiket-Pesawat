<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="m-0 font-weight-bold text-primary">Daftar Transaksi Admin</h3>
        </div>
        <div class="col-md-6">
            <form action="<?= base_url('admin/transaksi') ?>" method="get" class="d-flex justify-content-end">
                <div class="input-group" style="max-width: 300px;">
                    <input
                        type="text"
                        class="form-control"
                        name="search"
                        placeholder="Cari email atau ID pesanan..."
                        value="<?= isset($search) ? esc($search) : '' ?>">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                    <?php if (isset($search) && $search): ?>
                        <a href="<?= base_url('admin/transaksi') ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <?php if (isset($search) && $search): ?>
        <div class="alert alert-info mb-4">
            <i class="fas fa-info-circle me-2"></i>
            Menampilkan hasil pencarian untuk: "<?= esc($search) ?>"
        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Pesawat</th>
                            <th>Email Pengguna</th>
                            <th>Rute Penerbangan</th>
                            <th>Jadwal</th>
                            <th>Detail</th>
                            <th>Pembayaran</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pesanan)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                        <p class="mb-0">Tidak ada transaksi yang ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach ($pesanan as $data): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="fw-bold"><?= esc($data->nama_pesawat); ?></div>
                                                <small class="text-muted">ID: #<?= str_pad($data->id_pesanan, 5, '0', STR_PAD_LEFT); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= esc($data->email); ?></td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="route-info">
                                                <span class="fw-semibold"><?= esc($data->asal); ?></span>
                                                <span class="fw-semibold">Ke</span>
                                                <span class="fw-semibold"><?= esc($data->tujuan); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <small class="text-muted">Pergi:</small>
                                            <div><?= date('d M Y', strtotime($data->tanggal_pergi)); ?></div>
                                            <?php if ($data->tgl_pulang): ?>
                                                <small class="text-muted mt-1">Pulang:</small>
                                                <div><?= date('d M Y', strtotime($data->tgl_pulang)); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="mb-1">
                                                <i class="fas fa-users me-1"></i>
                                                <span><?= esc($data->penumpang); ?> Penumpang</span>
                                            </div>
                                            <div class="text-primary fw-bold">
                                                Rp <?= number_format($data->total, 0, ',', '.'); ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold"><?= esc($data->metode_pembayaran); ?></span>
                                            <?php if ($data->tgl_pembayaran): ?>
                                                <small class="text-muted">
                                                    <?= date('d/m/Y H:i', strtotime($data->tgl_pembayaran)); ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <?php if (!$data->tgl_pembayaran && !$data->deleted_at): ?>
                                                <button type="button"
                                                    class="btn btn-success btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#konfirmasiModal<?= $data->id_pesanan; ?>"
                                                    title="Konfirmasi Pembayaran">
                                                    <i class="fas fa-check"></i> Konfirmasi
                                                </button>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#batalkanModal<?= $data->id_pesanan; ?>"
                                                    title="Batalkan Pesanan">
                                                    <i class="fas fa-times"></i> Batalkan
                                                </button>
                                            <?php else: ?>
                                                <?php if ($data->tgl_pembayaran): ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i>Terkonfirmasi
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="konfirmasiModal<?= $data->id_pesanan; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <h6>Detail Pesanan:</h6>
                                                    <div class="ps-3">
                                                        <p class="mb-1">ID Pesanan: #<?= str_pad($data->id_pesanan, 5, '0', STR_PAD_LEFT); ?></p>
                                                        <p class="mb-1">Total Pembayaran: Rp <?= number_format($data->total, 0, ',', '.'); ?></p>
                                                    </div>
                                                </div>
                                                <p>Apakah Anda yakin ingin mengkonfirmasi pembayaran untuk pesanan ini? Mohon cek detail terlebih dahulu.</p>
                                                <div class="alert alert-info">
                                                    <small>
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Pastikan pembayaran telah diterima sebelum melakukan konfirmasi.
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-success"
                                                    onclick="window.location.href='<?= base_url('admin/transaksi/konfirmasi/' . $data->id_pesanan); ?>'">
                                                    Ya, Konfirmasi Pembayaran
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="batalkanModal<?= $data->id_pesanan; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Pembatalan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda yakin ingin membatalkan pesanan ini?</p>
                                                <div class="alert alert-warning">
                                                    <small>
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Pembatalan tidak dapat dibatalkan kembali.
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="window.location.href='<?= base_url('admin/transaksi/batalkan/' . $data->id_pesanan); ?>'">
                                                    Ya, Batalkan Pesanan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php if (session()->getFlashdata('success')): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>