<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    /* Minimal custom CSS for features not available in Bootstrap */
    .sidebar {
      width: 280px;
      min-height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
    }

    .content {
      margin-left: 280px;
    }

    .nav-link {
      transition: all 0.3s ease;
      color: white !important;
      /* Ensure text color is white */
    }

    .nav-link:hover,
    .nav-link:focus {
      color: #fff !important;
      /* Ensure hover/focus text color is white */
      background-color: rgba(255, 255, 255, 0.1);
      /* Slight background change on hover */
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        position: relative;
      }

      .content {
        margin-left: 0;
      }
    }
  </style>
</head>

<body class="bg-light">
  <!-- Sidebar -->
  <div class="sidebar bg-dark text-white shadow">
    <!-- Logo Section -->
    <div class="d-flex flex-column align-items-center border-bottom border-secondary py-4">
      <h4 class="mb-3">Tiket Pesawat</h4>
    </div>

    <!-- Navigation -->
    <nav class="mt-3">
      <div class="px-3">
        <a href="<?= base_url('admin'); ?>" class="nav-link rounded-3 mb-2 d-flex align-items-center text-white-50 hover-overlay">
          <i class="fas fa-home me-3"></i> Dashboard
        </a>
        <a href="<?= base_url('admin/Wisata'); ?>" class="nav-link rounded-3 mb-2 d-flex align-items-center text-white-50">
          <i class="fas fa-plane me-3"></i> Daftar Tiket
        </a>
        <a href="<?= base_url('admin/petugas'); ?>" class="nav-link rounded-3 mb-2 d-flex align-items-center text-white-50">
          <i class="fas fa-users me-3"></i> Admin
        </a>
        <a href="<?= base_url('admin/transaksi'); ?>" class="nav-link rounded-3 mb-2 d-flex align-items-center text-white-50">
          <i class="fas fa-receipt me-3"></i> Transaksi
        </a>
        <a href="<?= base_url('admin/login/keluar'); ?>" class="nav-link rounded-3 mb-2 d-flex align-items-center text-white-50">
          <i class="fas fa-sign-out-alt me-3"></i> Logout
        </a>
      </div>
    </nav>
  </div>

  <!-- Content -->
  <div class="content">
    <!-- Main Content -->
    <div class="container-fluid px-4">
      <div class="row">
        <div class="col-12">
          <?= $this->renderSection('content'); ?>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer>
    </footer>
  </div>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JavaScript for hover effects -->
  <script>
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('mouseenter', function() {
        this.classList.add('bg-secondary', 'bg-opacity-25', 'text-white');
      });
      link.addEventListener('mouseleave', function() {
        this.classList.remove('bg-secondary', 'bg-opacity-25', 'text-white');
      });
    });
  </script>
</body>

</html>