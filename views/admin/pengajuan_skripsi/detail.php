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
    <title>Detail Pengajuan Skripsi - Admin Dashboard</title>
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
        .info-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .badge {
            border-radius: 20px;
            padding: 8px 12px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-file-alt me-2"></i>Detail Pengajuan Skripsi</h2>
                        <p class="mb-0">Informasi lengkap pengajuan skripsi</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=PengajuanSkripsi&action=index" class="btn btn-light me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="index.php?role=admin&controller=PengajuanSkripsi&action=edit&id=<?php echo $pengajuan['id']; ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <!-- Informasi Utama -->
                    <div class="info-card">
                        <h4><i class="fas fa-info-circle me-2 text-primary"></i>Informasi Pengajuan</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-primary"><?php echo htmlspecialchars($pengajuan['judul']); ?></h5>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-calendar me-2"></i>
                                    Tanggal Pengajuan: <span class="badge bg-info"><?php echo date('d/m/Y', strtotime($pengajuan['tanggal'])); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Mahasiswa -->
                    <div class="info-card">
                        <h4><i class="fas fa-user-graduate me-2 text-success"></i>Informasi Mahasiswa</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Nama Mahasiswa:</strong> <?php echo htmlspecialchars($pengajuan['mahasiswa_nama']); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Pengajuan -->
                    <div class="info-card">
                        <h4><i class="fas fa-tasks me-2 text-warning"></i>Status Pengajuan</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $status = strtolower($pengajuan['status']);
                                $badgeClass = '';
                                $icon = '';
                                $description = '';
                                
                                switch ($status) {
                                    case 'disetujui':
                                        $badgeClass = 'bg-success';
                                        $icon = 'fas fa-check-circle';
                                        $description = 'Pengajuan skripsi telah disetujui dan dapat dilanjutkan ke tahap berikutnya.';
                                        break;
                                    case 'ditolak':
                                        $badgeClass = 'bg-danger';
                                        $icon = 'fas fa-times-circle';
                                        $description = 'Pengajuan skripsi ditolak dan perlu perbaikan atau pengajuan ulang.';
                                        break;
                                    case 'menunggu':
                                        $badgeClass = 'bg-warning';
                                        $icon = 'fas fa-clock';
                                        $description = 'Pengajuan skripsi sedang menunggu review dari admin/dosen.';
                                        break;
                                    case 'revisi':
                                        $badgeClass = 'bg-info';
                                        $icon = 'fas fa-edit';
                                        $description = 'Pengajuan skripsi memerlukan revisi sebelum dapat disetujui.';
                                        break;
                                    default:
                                        $badgeClass = 'bg-secondary';
                                        $icon = 'fas fa-question-circle';
                                        $description = 'Status pengajuan tidak diketahui.';
                                }
                                ?>
                                <div class="text-center">
                                    <span class="badge <?php echo $badgeClass; ?> fs-6">
                                        <i class="<?php echo $icon; ?> me-2"></i>
                                        <?php echo htmlspecialchars($pengajuan['status']); ?>
                                    </span>
                                    <p class="mt-3 text-muted"><?php echo $description; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- ID Pengajuan -->
                    <div class="info-card">
                        <h4><i class="fas fa-hashtag me-2 text-info"></i>ID Pengajuan</h4>
                        <hr>
                        <div class="text-center">
                            <span class="badge bg-secondary fs-4">#<?php echo $pengajuan['id']; ?></span>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="info-card">
                        <h4><i class="fas fa-history me-2 text-secondary"></i>Timeline</h4>
                        <hr>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($pengajuan['tanggal'])); ?></small>
                                    <p class="mb-0">Pengajuan dibuat</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-<?php echo $status == 'menunggu' ? 'warning' : ($status == 'disetujui' ? 'success' : ($status == 'ditolak' ? 'danger' : 'info')); ?>"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">Status saat ini</small>
                                    <p class="mb-0"><?php echo htmlspecialchars($pengajuan['status']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="info-card">
                        <h4><i class="fas fa-cogs me-2 text-secondary"></i>Aksi</h4>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="index.php?role=admin&controller=PengajuanSkripsi&action=edit&id=<?php echo $pengajuan['id']; ?>" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-2"></i>Edit Pengajuan
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

    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-marker {
            position: absolute;
            left: -35px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
        .timeline-content {
            padding-left: 10px;
        }
        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: -29px;
            top: 17px;
            width: 2px;
            height: 20px;
            background: #dee2e6;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 