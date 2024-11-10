<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid px-0">
    <div class="row">
        <div class="col-lg-12 position-relative">
            <img src="https://i.pinimg.com/564x/d0/ad/09/d0ad096d92b6d44f8d0db0d25e30b96f.jpg" class="d-block w-100" alt="Gambar Awal">

            <div class="position-absolute top-50 start-50 translate-middle bg-dark bg-opacity-75 rounded-4 p-5 shadow-lg text-center" style="max-width: 75%;">
                <h1 class="display-4 text-light fw-bold text-uppercase mb-3" style="letter-spacing: 4px; text-shadow: 3px 3px 5px rgba(0,0,0,0.8);">
                    Selamat Datang
                </h1>
                <h2 class="display-6 text-warning fw-bold mb-4" style="letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
                    Di Website Pemesanan Tiket Pesawat
                </h2>
                <p class="text-light" style="font-size: 1.3rem; line-height: 1.5; text-shadow: 1px 1px 3px rgba(0,0,0,0.6);">
                    Pesan tiket pesawat Anda dengan <span class="fw-bold text-warning">mudah</span>, <span class="fw-bold text-warning">cepat</span>, dan <span class="fw-bold text-warning">aman</span>. Temukan penawaran terbaik hanya di sini!
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>