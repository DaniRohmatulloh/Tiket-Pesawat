<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Edit Admin Data</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('admin/petugas/update'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="kode" value="<?= $cari->id_admin; ?>">

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Full Name</label>
                            <input type="text"
                                name="nama"
                                id="nama"
                                class="form-control <?= session('errors.nama') ? 'is-invalid' : ''; ?>"
                                value="<?= old('nama', $cari->nama); ?>"
                                placeholder="Enter full name">
                            <div class="invalid-feedback">
                                <?= session('errors.nama'); ?>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email"
                                name="email"
                                id="email"
                                class="form-control <?= session('errors.email') ? 'is-invalid' : ''; ?>"
                                value="<?= old('email', $cari->email); ?>"
                                placeholder="Enter email address">
                            <div class="invalid-feedback">
                                <?= session('errors.email'); ?>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password"
                                    name="password"
                                    id="password"
                                    class="form-control <?= session('errors.password') ? 'is-invalid' : ''; ?>"
                                    placeholder="Enter new password">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="invalid-feedback">
                                    <?= session('errors.password'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="<?= base_url('admin/petugas'); ?>" class="btn btn-light border">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
</script>

<?= $this->endSection(); ?>