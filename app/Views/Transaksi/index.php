<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h3 class="text-center mt-2">Transaksi</h3>

<div class="mt-4 p-5">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Pesawat</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Pergi</th>
                    <th>Pulang</th>
                    <th>Penumpang</th>
                    <th>Metode</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pesanan as $data): ?>
                    <tr>
                        <td><?= esc($data->nama_pesawat); ?></td>
                        <td><?= esc($data->asal); ?></td>
                        <td><?= esc($data->tujuan); ?></td>
                        <td><?= esc($data->tanggal_pergi); ?></td>
                        <td><?= esc($data->tgl_pulang); ?></td>
                        <td><?= esc($data->penumpang); ?></td>
                        <td><?= esc($data->metode_pembayaran); ?></td>
                        <td>Rp.<?= esc($data->total); ?></td>
                        <td>
                            <?php if ($data->tgl_pembayaran == null && $data->deleted_at == null): ?>
                                <span class="badge bg-warning">Belum Dibayar</span>
                            <?php elseif ($data->deleted_at != null): ?>
                                <span class="badge bg-danger">Dibatalkan</span>
                            <?php else: ?>
                                <span class="badge bg-success">Sudah Dibayar</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-success btn-sm">Konfirmasi</a>
                            <a href="#" class="btn btn-danger btn-sm">Batalkan</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection(); ?>