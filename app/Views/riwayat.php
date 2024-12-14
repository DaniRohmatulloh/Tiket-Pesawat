<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="mb-0 text-gray-800">
                <i class="fas fa-history me-2 text-primary"></i>Riwayat Pesanan
            </h2>
        </div>
        <div class="col-md-6 text-end">
            <div class="badge bg-soft-primary text-primary p-2">
                <i class="far fa-clock me-1"></i>
                <?= date('d M Y - H:i:s'); ?>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center ps-4">No</th>
                            <th>Informasi Pesawat</th>
                            <th>Rute Perjalanan</th>
                            <th>Jadwal Keberangkatan</th>
                            <th>Detail Pesanan</th>
                            <th class="text-end pe-4">Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pesanan)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center text-muted">
                                        <i class="fas fa-box-open fa-4x mb-3 opacity-50"></i>
                                        <h4 class="mb-2">Tidak Ada Transaksi</h4>
                                        <p class="text-muted">Anda belum memiliki riwayat pemesanan</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach ($pesanan as $data): ?>
                                <tr>
                                    <td class="text-center ps-4 fw-bold"><?= $no++; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="fw-bold text-primary"><?= esc($data->nama_pesawat ?? 'Tidak Diketahui'); ?></div>
                                                <small class="text-muted">ID Pesanan: #<?= str_pad($data->id_pesanan ?? 0, 5, '0', STR_PAD_LEFT); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold text-dark"><?= esc($data->asal ?? 'Tidak Tersedia'); ?></span>
                                            <span class="text-muted text-center my-1">→</span>
                                            <span class="fw-semibold text-dark"><?= esc($data->tujuan ?? 'Tidak Tersedia'); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="badge bg-soft-success text-success">
                                                <i class="far fa-calendar me-1"></i>
                                                <?= isset($data->tanggal_pergi) ?
                                                    date('d M Y', strtotime($data->tanggal_pergi)) :
                                                    'Tanggal Tidak Tersedia'; ?>
                                            </div>
                                            <div class="badge bg-soft-info text-info mt-1">
                                                <i class="far fa-clock me-1"></i>
                                                <?php
                                                $jam_berangkat = $data->jam_berangkat ?? null;
                                                if (!empty($jam_berangkat)) {
                                                    echo date('H:i', strtotime($jam_berangkat)) . ' WIB';
                                                } else {
                                                    echo 'Jam Tidak Tersedia';
                                                }
                                                ?>
                                            </div>
                                            <?php if (isset($data->tgl_pulang) && $data->tgl_pulang): ?>
                                                <div class="badge bg-soft-warning text-warning mt-1">
                                                    <i class="far fa-calendar-check me-1"></i>
                                                    <?= date('d M Y', strtotime($data->tgl_pulang)); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="mb-1">
                                                <i class="fas fa-users me-1 text-muted"></i>
                                                <span><?= esc($data->penumpang ?? '0'); ?> Penumpang</span>
                                            </div>
                                            <div class="text-primary fw-bold">
                                                Rp <?= number_format($data->total ?? 0, 0, ',', '.'); ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex flex-column align-items-end">
                                            <span class="badge 
                                                <?= ($data->metode_pembayaran ?? '') == 'Lunas' ? 'bg-soft-success text-success' : 'bg-soft-warning text-warning'; ?>">
                                                <?= esc($data->metode_pembayaran ?? 'Belum Bayar'); ?>
                                            </span>
                                            <?php if (isset($data->tgl_pembayaran) && $data->tgl_pembayaran): ?>
                                                <small class="text-muted mt-1">
                                                    <?= date('d/m/Y H:i', strtotime($data->tgl_pembayaran)); ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>