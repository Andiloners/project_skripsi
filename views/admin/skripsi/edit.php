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
    <title>Edit Skripsi - Admin Dashboard</title>
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
                        <h2><i class="fas fa-edit me-2"></i>Edit Skripsi</h2>
                        <p class="mb-0">Edit data skripsi mahasiswa</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=Skripsi&action=index" class="btn btn-light me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="index.php?role=admin&controller=Skripsi&action=detail&id=<?php echo $skripsi['id']; ?>" class="btn btn-info">
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
                            <h5><i class="fas fa-edit me-2"></i>Form Edit Data Skripsi</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="judul" class="form-label">
                                            <i class="fas fa-book me-2"></i>Judul Skripsi
                                        </label>
                                        <input type="text" class="form-control" id="judul" name="judul" 
                                               value="<?php echo htmlspecialchars($skripsi['judul']); ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="mahasiswa_id" class="form-label">
                                            <i class="fas fa-user-graduate me-2"></i>Mahasiswa
                                        </label>
                                        <select class="form-select" id="mahasiswa_id" name="mahasiswa_id" required>
                                            <option value="">Pilih Mahasiswa</option>
                                            <?php foreach ($mahasiswa as $mhs): ?>
                                                <option value="<?php echo $mhs['id']; ?>" 
                                                        <?php echo ($mhs['id'] == $skripsi['mahasiswa_id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($mhs['nama'] . ' (' . $mhs['nim'] . ')'); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="dosen_id" class="form-label">
                                            <i class="fas fa-chalkboard-teacher me-2"></i>Dosen Pembimbing
                                        </label>
                                        <select class="form-select" id="dosen_id" name="dosen_id" required>
                                            <option value="">Pilih Dosen</option>
                                            <?php foreach ($dosen as $dsn): ?>
                                                <option value="<?php echo $dsn['id']; ?>"
                                                        <?php echo ($dsn['id'] == $skripsi['dosen_id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($dsn['nama']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tahun" class="form-label">
                                            <i class="fas fa-calendar me-2"></i>Tahun
                                        </label>
                                        <select class="form-select" id="tahun" name="tahun" required>
                                            <option value="">Pilih Tahun</option>
                                            <?php for ($i = date('Y'); $i >= date('Y') - 5; $i--): ?>
                                                <option value="<?php echo $i; ?>" 
                                                        <?php echo ($i == $skripsi['tahun']) ? 'selected' : ''; ?>>
                                                    <?php echo $i; ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="ruang_penyimpanan_id" class="form-label">
                                            <i class="fas fa-warehouse me-2"></i>Ruang Penyimpanan
                                        </label>
                                        <select class="form-select" id="ruang_penyimpanan_id" name="ruang_penyimpanan_id">
                                            <option value="">Pilih Ruang (Opsional)</option>
                                            <?php foreach ($ruang as $rg): ?>
                                                <option value="<?php echo $rg['id']; ?>"
                                                        <?php echo ($rg['id'] == $skripsi['ruang_penyimpanan_id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($rg['nama'] . ' - ' . $rg['lokasi']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="index.php?role=admin&controller=Skripsi&action=index" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Skripsi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Informasi Skripsi -->
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-info-circle me-2"></i>Informasi Skripsi</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="text-primary"><?php echo htmlspecialchars($skripsi['judul']); ?></h6>
                            <hr>
                            <p><strong>ID Skripsi:</strong><br>
                               <span class="badge bg-secondary">#<?php echo $skripsi['id']; ?></span></p>
                            <p><strong>File Arsip:</strong><br>
                               <?php if ($skripsi['file_arsip']): ?>
                                   <span class="badge bg-success">Ada</span>
                               <?php else: ?>
                                   <span class="badge bg-warning">Belum ada</span>
                               <?php endif; ?>
                            </p>
                            <p><strong>Ruang Penyimpanan:</strong><br>
                               <?php if ($skripsi['ruang_penyimpanan_id']): ?>
                                   <span class="badge bg-info">Sudah ditentukan</span>
                               <?php else: ?>
                                   <span class="badge bg-secondary">Belum ditentukan</span>
                               <?php endif; ?>
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
                                <a href="index.php?role=admin&controller=Skripsi&action=detail&id=<?php echo $skripsi['id']; ?>" 
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 