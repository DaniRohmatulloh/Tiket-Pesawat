<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php
function buatRp($angka)
{
    return "Rp" . number_format($angka, 2, ',', '.');
}
?>
<div class="container py-5">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h4 class="mb-4">Konfirmasi Pembayaran</h4>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Konfirmasi Pesanan</h5>
        </div>
        <div class="card-body">
            <?php if ($pesanan): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Asal</th>
                                <th>Tujuan</th>
                                <th>Tanggal Pergi</th>
                                <th>Tanggal Pulang</th>
                                <th>Penumpang</th>
                                <th>Nama Pesawat</th>
                                <th>Harga</th>
                                <th>Metode Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= esc($pesanan->asal); ?></td>
                                <td><?= esc($pesanan->tujuan); ?></td>
                                <td><?= esc($pesanan->tanggal_pergi); ?></td>
                                <td><?= esc($pesanan->tgl_pulang); ?></td>
                                <td><?= esc($pesanan->penumpang); ?></td>
                                <td>
                                    <?php
                                    if (isset($pesanan->nama_pesawat) && $pesanan->nama_pesawat !== null && $pesanan->nama_pesawat !== '') {
                                        echo esc($pesanan->nama_pesawat);
                                    } else {
                                        echo '<span class="text-muted">Nama Pesawat Tidak Tersedia</span>';
                                    }
                                    ?>
                                </td>
                                <td><?= buatRp($pesanan->harga); ?></td>
                                <td><?= esc($pesanan->metode_pembayaran); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="paymentInstructions" class="payment-instructions mt-4">
                    <h6>Instruksi Pembayaran:</h6>
                    <ol class="list-group list-group-numbered">
                        <?php if (!empty($instructions[$pesanan->metode_pembayaran])): ?>
                            <?php foreach ($instructions[$pesanan->metode_pembayaran] as $step): ?>
                                <li class="list-group-item"><?= esc($step); ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item">Instruksi tidak tersedia.</li>
                        <?php endif; ?>
                    </ol>
                </div>
                <div class="mt-4">
                    <button onclick="konfirmasiPemesanan()" class="btn btn-primary">
                        <i class="bi bi-check2-circle me-2"></i>Konfirmasi Pemesanan
                    </button>
                </div>
            <?php else: ?>
                <p class="text-center">Pesanan tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function konfirmasiPemesanan() {
        Swal.fire({
            title: 'Konfirmasi Pemesanan',
            text: "Apakah Anda yakin ingin mengkonfirmasi pesanan ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Konfirmasi!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Pesanan berhasil dikonfirmasi',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '<?= base_url('/'); ?>';
                });
            }
        });
    }
</script>

<?= $this->endSection(); ?>