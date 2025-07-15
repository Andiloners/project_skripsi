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
    <title>Tambah Skripsi - Admin Dashboard</title>
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
                        <h2><i class="fas fa-plus-circle me-2"></i>Tambah Skripsi Baru</h2>
                        <p class="mb-0">Tambah data skripsi mahasiswa baru</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=Skripsi&action=index" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
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
                            <h5><i class="fas fa-edit me-2"></i>Form Data Skripsi</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="judul" class="form-label">
                                            <i class="fas fa-book me-2"></i>Judul Skripsi
                                        </label>
                                        <input type="text" class="form-control" id="judul" name="judul" 
                                               placeholder="Masukkan judul skripsi" required>
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
                                                <option value="<?php echo $mhs['id']; ?>">
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
                                                <option value="<?php echo $dsn['id']; ?>">
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
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
                                                <option value="<?php echo $rg['id']; ?>">
                                                    <?php echo htmlspecialchars($rg['nama'] . ' - ' . $rg['lokasi']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="file_arsip" class="form-label">
                                            <i class="fas fa-file-upload me-2"></i>File Arsip (Opsional)
                                        </label>
                                        <input type="file" class="form-control" id="file_arsip" name="file_arsip" 
                                               accept=".pdf,.doc,.docx">
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Format: PDF, DOC, DOCX (Maksimal 10MB)
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="index.php?role=admin&controller=Skripsi&action=index" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Skripsi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Informasi -->
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-info-circle me-2"></i>Informasi</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Semua field wajib diisi kecuali file arsip
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    File arsip bisa diupload nanti
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Ruang penyimpanan bisa ditentukan nanti
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Data akan langsung tersimpan ke database
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Statistik -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5><i class="fas fa-chart-bar me-2"></i>Statistik</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <h4 class="text-primary"><?php echo count($mahasiswa); ?></h4>
                                    <small class="text-muted">Mahasiswa</small>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-success"><?php echo count($dosen); ?></h4>
                                    <small class="text-muted">Dosen</small>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <h4 class="text-warning"><?php echo count($ruang); ?></h4>
                                    <small class="text-muted">Ruang Arsip</small>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-info"><?php echo date('Y'); ?></h4>
                                    <small class="text-muted">Tahun Aktif</small>
                                </div>
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