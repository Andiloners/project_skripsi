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
    <title>Daftar Pengajuan Skripsi - Admin Dashboard</title>
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
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
            transition: all 0.3s ease;
        }
        .badge {
            border-radius: 20px;
            padding: 8px 12px;
        }
        .action-buttons .btn {
            margin: 2px;
            border-radius: 6px;
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 6px 12px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2><i class="fas fa-file-alt me-2"></i>Daftar Pengajuan Skripsi</h2>
                        <p class="mb-0">Kelola pengajuan skripsi mahasiswa</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="index.php?role=admin&controller=PengajuanSkripsi&action=tambah" class="btn btn-light">
                            <i class="fas fa-plus me-2"></i>Tambah Pengajuan
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

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Mahasiswa</th>
                            <th width="35%">Judul Skripsi</th>
                            <th width="15%">Tanggal Pengajuan</th>
                            <th width="15%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($pengajuan) && is_array($pengajuan) && count($pengajuan) > 0): ?>
                            <?php $no = 1; foreach ($pengajuan as $item): ?>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-primary"><?php echo $no++; ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            <div>
                                                <strong><?php echo htmlspecialchars($item['mahasiswa_nama']); ?></strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="text-primary"><?php echo htmlspecialchars($item['judul']); ?></strong>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar me-2 text-info"></i>
                                        <?php echo date('d/m/Y', strtotime($item['tanggal'])); ?>
                                    </td>
                                    <td>
                                        <?php
                                        $status = strtolower($item['status']);
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
                                        <span class="badge <?php echo $badgeClass; ?> status-badge">
                                            <i class="<?php echo $icon; ?> me-1"></i>
                                            <?php echo htmlspecialchars($item['status']); ?>
                                        </span>
                                    </td>
                                    <td class="action-buttons">
                                        <a href="index.php?role=admin&controller=PengajuanSkripsi&action=detail&id=<?php echo $item['id']; ?>" 
                                           class="btn btn-sm btn-info" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="index.php?role=admin&controller=PengajuanSkripsi&action=edit&id=<?php echo $item['id']; ?>" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="index.php?role=admin&controller=PengajuanSkripsi&action=hapus&id=<?php echo $item['id']; ?>" 
                                           class="btn btn-sm btn-danger" title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus pengajuan ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <h5>Belum ada pengajuan skripsi</h5>
                                        <p>Silakan tambahkan pengajuan baru untuk memulai</p>
                                        <a href="index.php?role=admin&controller=PengajuanSkripsi&action=tambah" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Pengajuan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if (isset($pengajuan) && is_array($pengajuan) && count($pengajuan) > 0): ?>
                <!-- Statistik -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <h4><?php echo count(array_filter($pengajuan, function($item) { return strtolower($item['status']) == 'disetujui'; })); ?></h4>
                                <small>Disetujui</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <h4><?php echo count(array_filter($pengajuan, function($item) { return strtolower($item['status']) == 'menunggu'; })); ?></h4>
                                <small>Menunggu</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-times-circle fa-2x mb-2"></i>
                                <h4><?php echo count(array_filter($pengajuan, function($item) { return strtolower($item['status']) == 'ditolak'; })); ?></h4>
                                <small>Ditolak</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-edit fa-2x mb-2"></i>
                                <h4><?php echo count(array_filter($pengajuan, function($item) { return strtolower($item['status']) == 'revisi'; })); ?></h4>
                                <small>Revisi</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <p class="text-muted">
                            <i class="fas fa-info-circle me-2"></i>
                            Total: <strong><?php echo count($pengajuan); ?></strong> pengajuan
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="index.php?role=admin&controller=Dashboard&action=index" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
