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
    <title>Detail Skripsi - Admin Dashboard</title>
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
                        <h2><i class="fas fa-book-open me-2"></i>Detail Skripsi</h2>
                        <p class="mb-0">Informasi lengkap skripsi mahasiswa</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=Skripsi&action=index" class="btn btn-light me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="index.php?role=admin&controller=Skripsi&action=edit&id=<?php echo $skripsi['id']; ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <!-- Informasi Utama -->
                    <div class="info-card">
                        <h4><i class="fas fa-info-circle me-2 text-primary"></i>Informasi Skripsi</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-primary"><?php echo htmlspecialchars($skripsi['judul']); ?></h5>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-calendar me-2"></i>
                                    Tahun: <span class="badge bg-info"><?php echo htmlspecialchars($skripsi['tahun']); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Mahasiswa -->
                    <div class="info-card">
                        <h4><i class="fas fa-user-graduate me-2 text-success"></i>Informasi Mahasiswa</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nama:</strong> <?php echo htmlspecialchars($skripsi['mahasiswa_nama'] ?? 'N/A'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>NIM:</strong> <?php echo htmlspecialchars($skripsi['nim'] ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Dosen -->
                    <div class="info-card">
                        <h4><i class="fas fa-chalkboard-teacher me-2 text-warning"></i>Informasi Dosen</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nama:</strong> <?php echo htmlspecialchars($skripsi['dosen_nama'] ?? 'N/A'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>NIP:</strong> <?php echo htmlspecialchars($skripsi['nip'] ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- File Arsip -->
                    <div class="info-card">
                        <h4><i class="fas fa-file-pdf me-2 text-danger"></i>File Arsip</h4>
                        <hr>
                        <?php if ($skripsi['file_arsip']): ?>
                            <div class="text-center">
                                <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                <p><strong><?php echo htmlspecialchars($skripsi['file_arsip']); ?></strong></p>
                                <a href="uploads/<?php echo htmlspecialchars($skripsi['file_arsip']); ?>" 
                                   target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fas fa-download me-2"></i>Download
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="text-center text-muted">
                                <i class="fas fa-file-pdf fa-3x mb-3"></i>
                                <p>Belum ada file arsip</p>
                                <a href="index.php?role=admin&controller=Skripsi&action=upload_arsip&id=<?php echo $skripsi['id']; ?>" 
                                   class="btn btn-success btn-sm">
                                    <i class="fas fa-upload me-2"></i>Upload Arsip
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Ruang Penyimpanan -->
                    <div class="info-card">
                        <h4><i class="fas fa-warehouse me-2 text-info"></i>Ruang Penyimpanan</h4>
                        <hr>
                        <?php if ($skripsi['ruang_nama']): ?>
                            <div class="text-center">
                                <i class="fas fa-warehouse fa-2x text-info mb-2"></i>
                                <p><strong><?php echo htmlspecialchars($skripsi['ruang_nama']); ?></strong></p>
                            </div>
                        <?php else: ?>
                            <div class="text-center text-muted">
                                <i class="fas fa-warehouse fa-2x mb-2"></i>
                                <p>Belum ditentukan</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Aksi -->
                    <div class="info-card">
                        <h4><i class="fas fa-cogs me-2 text-secondary"></i>Aksi</h4>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="index.php?role=admin&controller=Skripsi&action=edit&id=<?php echo $skripsi['id']; ?>" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-2"></i>Edit Skripsi
                            </a>
                            <a href="index.php?role=admin&controller=Skripsi&action=upload_arsip&id=<?php echo $skripsi['id']; ?>" 
                               class="btn btn-success btn-sm">
                                <i class="fas fa-upload me-2"></i>Upload Arsip
                            </a>
                            <a href="index.php?role=admin&controller=Skripsi&action=hapus&id=<?php echo $skripsi['id']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus skripsi ini?')">
                                <i class="fas fa-trash me-2"></i>Hapus Skripsi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
