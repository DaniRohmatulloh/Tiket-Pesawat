<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-5">
    <div class="d-flex justify-content-center mb-4">
        <div class="text-center">
            <h3 class="text-primary mb-3">Dashboard Admin</h3>
            <p class="text-muted">Selamat datang di dashboard admin. Kelola pesanan, transaksi, dan data penting lainnya dengan mudah di sini.</p>
        </div>
    </div>

    <!-- Card untuk Konten Halaman -->
    <div class="row">
        <!-- Card 1: Manajemen Transaksi -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg border-primary">
                <div class="card-header bg-primary text-white text-center">
                    <i class="fas fa-boxes fa-2x mb-2"></i>
                    <h5>Manajemen Transaksi</h5>
                </div>
                <div class="card-body text-center">
                    <p class="lead mb-3">Kelola dan pantau transaksi yang ada. Lihat status dan kelola pembayaran dengan mudah.</p>
                    <a href="<?= base_url('admin/transaksi'); ?>" class="btn btn-outline-primary btn-lg">Lihat Daftar Transaksi</a>
                </div>
            </div>
        </div>

        <!-- Card 2: Pengelolaan Tiket -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg border-success">
                <div class="card-header bg-success text-white text-center">
                    <i class="fas fa-plane-departure fa-2x mb-2"></i>
                    <h5>Pengelolaan Tiket</h5>
                </div>
                <div class="card-body text-center">
                    <p class="lead mb-3">Tambah, edit, dan hapus data tiket pesawat dengan cepat dan mudah.</p>
                    <a href="<?= base_url('admin/Wisata'); ?>" class="btn btn-outline-success btn-lg">Kelola Tiket</a>
                </div>
            </div>
        </div>

        <!-- Card 3: Pengelolaan Admin -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg border-warning">
                <div class="card-header bg-warning text-dark text-center">
                    <i class="fas fa-users-cog fa-2x mb-2"></i>
                    <h5>Pengelolaan Admin</h5>
                </div>
                <div class="card-body text-center">
                    <p class="lead mb-3">Kelola pengaturan admin dan hak akses pengguna dengan mudah.</p>
                    <a href="<?= base_url('admin/petugas'); ?>" class="btn btn-outline-warning btn-lg">Kelola Admin</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>