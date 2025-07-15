<?php
if (!isset($conn)) {
    require_once __DIR__ . '/../../../config/config.php';
    global $conn;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengajuan Skripsi - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .main-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 30px;
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-edit me-2"></i>Edit Pengajuan Skripsi</h2>
                        <p class="mb-0">Edit data pengajuan skripsi</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=PengajuanSkripsi&action=index" class="btn btn-light me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="index.php?role=admin&controller=PengajuanSkripsi&action=detail&id=<?php echo $pengajuan['id']; ?>" class="btn btn-info">
                            <i class="fas fa-eye me-2"></i>Detail
                        </a>
                    </div>
                </div>
            </div>

            <?php if (isset($error) && $error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-edit me-2"></i>Form Edit Pengajuan Skripsi</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="mahasiswa_nama" class="form-label">
                                            <i class="fas fa-user-graduate me-2"></i>Nama Mahasiswa
                                        </label>
                                        <input type="text" class="form-control" id="mahasiswa_nama" name="mahasiswa_nama" 
                                               value="<?php echo htmlspecialchars($pengajuan['mahasiswa_nama']); ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="judul" class="form-label">
                                            <i class="fas fa-book me-2"></i>Judul Skripsi
                                        </label>
                                        <textarea class="form-control" id="judul" name="judul" rows="3" 
                                                  required><?php echo htmlspecialchars($pengajuan['judul']); ?></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal" class="form-label">
                                            <i class="fas fa-calendar me-2"></i>Tanggal Pengajuan
                                        </label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" 
                                               value="<?php echo htmlspecialchars($pengajuan['tanggal']); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">
                                            <i class="fas fa-tasks me-2"></i>Status
                                        </label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Menunggu" <?php echo ($pengajuan['status'] == 'Menunggu') ? 'selected' : ''; ?>>Menunggu</option>
                                            <option value="Disetujui" <?php echo ($pengajuan['status'] == 'Disetujui') ? 'selected' : ''; ?>>Disetujui</option>
                                            <option value="Ditolak" <?php echo ($pengajuan['status'] == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                                            <option value="Revisi" <?php echo ($pengajuan['status'] == 'Revisi') ? 'selected' : ''; ?>>Revisi</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="index.php?role=admin&controller=PengajuanSkripsi&action=index" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Pengajuan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Informasi Pengajuan -->
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-info-circle me-2"></i>Informasi Pengajuan</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="text-primary"><?php echo htmlspecialchars($pengajuan['judul']); ?></h6>
                            <hr>
                            <p><strong>ID Pengajuan:</strong><br>
                               <span class="badge bg-secondary">#<?php echo $pengajuan['id']; ?></span></p>
                            <p><strong>Mahasiswa:</strong><br>
                               <?php echo htmlspecialchars($pengajuan['mahasiswa_nama']); ?></p>
                            <p><strong>Tanggal:</strong><br>
                               <i class="fas fa-calendar me-2 text-info"></i>
                               <?php echo date('d/m/Y', strtotime($pengajuan['tanggal'])); ?></p>
                            <p><strong>Status Saat Ini:</strong><br>
                               <?php
                               $status = strtolower($pengajuan['status']);
                               $badgeClass = '';
                               $icon = '';
                               
                               switch ($status) {
                                   case 'disetujui':
                                       $badgeClass = 'bg-success';
                                       $icon = 'fas fa-check-circle';
                                       break;
                                   case 'ditolak':
                                       $badgeClass = 'bg-danger';
                                       $icon = 'fas fa-times-circle';
                                       break;
                                   case 'menunggu':
                                       $badgeClass = 'bg-warning';
                                       $icon = 'fas fa-clock';
                                       break;
                                   case 'revisi':
                                       $badgeClass = 'bg-info';
                                       $icon = 'fas fa-edit';
                                       break;
                                   default:
                                       $badgeClass = 'bg-secondary';
                                       $icon = 'fas fa-question-circle';
                               }
                               ?>
                               <span class="badge <?php echo $badgeClass; ?>">
                                   <i class="<?php echo $icon; ?> me-1"></i>
                                   <?php echo htmlspecialchars($pengajuan['status']); ?>
                               </span>
                            </p>
                        </div>
                    </div>

                    <!-- Aksi Cepat -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5><i class="fas fa-bolt me-2"></i>Aksi Cepat</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="index.php?role=admin&controller=PengajuanSkripsi&action=detail&id=<?php echo $pengajuan['id']; ?>" 
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                </a>
                                <a href="index.php?role=admin&controller=PengajuanSkripsi&action=hapus&id=<?php echo $pengajuan['id']; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus pengajuan ini?')">
                                    <i class="fas fa-trash me-2"></i>Hapus Pengajuan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
