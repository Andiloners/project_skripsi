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
    <title>Daftar Skripsi - Admin Dashboard</title>
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2><i class="fas fa-book-open me-2"></i>Daftar Skripsi</h2>
                        <p class="mb-0">Kelola data skripsi mahasiswa</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="index.php?role=admin&controller=Skripsi&action=tambah" class="btn btn-light">
                            <i class="fas fa-plus me-2"></i>Simpan Skripsi Baru
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
                            <th width="25%">Judul Skripsi</th>
                            <th width="15%">Mahasiswa</th>
                            <th width="15%">Dosen</th>
                            <th width="10%">Tahun</th>
                            <th width="15%">Ruang Penyimpanan</th>
                            <th width="15%">File Arsip</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($skripsi) && is_array($skripsi) && count($skripsi) > 0): ?>
                            <?php $no = 1; foreach ($skripsi as $item): ?>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-primary"><?php echo $no++; ?></span>
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($item['judul']); ?></strong>
                                    </td>
                                    <td>
                                        <i class="fas fa-user-graduate me-2 text-primary"></i>
                                        <?php echo htmlspecialchars($item['mahasiswa_nama'] ?? 'N/A'); ?>
                                    </td>
                                    <td>
                                        <i class="fas fa-chalkboard-teacher me-2 text-success"></i>
                                        <?php echo htmlspecialchars($item['dosen_nama'] ?? 'N/A'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info"><?php echo htmlspecialchars($item['tahun']); ?></span>
                                    </td>
                                    <td>
                                        <i class="fas fa-warehouse me-2 text-warning"></i>
                                        <?php echo htmlspecialchars($item['ruang_nama'] ?? 'Belum ditentukan'); ?>
                                    </td>
                                    <td>
                                        <?php if ($item['file_arsip']): ?>
                                            <a href="uploads/<?php echo htmlspecialchars($item['file_arsip']); ?>" 
                                               target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf me-1"></i>Lihat
                                            </a>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Belum ada file</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="action-buttons">
                                        <a href="index.php?role=admin&controller=Skripsi&action=detail&id=<?php echo $item['id']; ?>" 
                                           class="btn btn-sm btn-info" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="index.php?role=admin&controller=Skripsi&action=edit&id=<?php echo $item['id']; ?>" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="index.php?role=admin&controller=Skripsi&action=upload_arsip&id=<?php echo $item['id']; ?>" 
                                           class="btn btn-sm btn-success" title="Upload Arsip">
                                            <i class="fas fa-upload"></i>
                                        </a>
                                        <a href="index.php?role=admin&controller=Skripsi&action=hapus&id=<?php echo $item['id']; ?>" 
                                           class="btn btn-sm btn-danger" title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus skripsi ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <h5>Belum ada data skripsi</h5>
                                        <p>Silakan tambahkan skripsi baru untuk memulai</p>
                                        <a href="index.php?role=admin&controller=Skripsi&action=tambah" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Skripsi
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if (isset($skripsi) && is_array($skripsi) && count($skripsi) > 0): ?>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <p class="text-muted">
                            <i class="fas fa-info-circle me-2"></i>
                            Total: <strong><?php echo count($skripsi); ?></strong> skripsi
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
