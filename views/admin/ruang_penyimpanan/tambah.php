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
    <title>Tambah Ruang Penyimpanan - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 30px;
        }
        .page-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
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
            border-color: #1e3c72;
            box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
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
        .tech-feature {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            border-left: 3px solid #1e3c72;
        }
        .storage-icon {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 15px;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-plus-circle me-2"></i>Tambah Ruang Penyimpanan</h2>
                        <p class="mb-0">Tambah ruang penyimpanan arsip skripsi digital baru</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=RuangPenyimpanan&action=index" class="btn btn-light">
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
                            <h5><i class="fas fa-server me-2"></i>Form Ruang Penyimpanan</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="nama" class="form-label">
                                            <i class="fas fa-server me-2"></i>Nama Ruang Penyimpanan
                                        </label>
                                        <input type="text" class="form-control" id="nama" name="nama" 
                                               placeholder="Contoh: Server Room A, Data Center 1, Cloud Storage" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="lokasi" class="form-label">
                                            <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                        </label>
                                        <select class="form-select" id="lokasi" name="lokasi" required>
                                            <option value="">Pilih Lokasi</option>
                                            <option value="Gedung A - Lantai 1">Gedung A - Lantai 1</option>
                                            <option value="Gedung A - Lantai 2">Gedung A - Lantai 2</option>
                                            <option value="Gedung B - Lantai 1">Gedung B - Lantai 1</option>
                                            <option value="Gedung B - Lantai 2">Gedung B - Lantai 2</option>
                                            <option value="Data Center">Data Center</option>
                                            <option value="Server Room">Server Room</option>
                                            <option value="Cloud Storage">Cloud Storage</option>
                                            <option value="Backup Center">Backup Center</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="keterangan" class="form-label">
                                            <i class="fas fa-info-circle me-2"></i>Keterangan
                                        </label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" 
                                                  placeholder="Deskripsi ruang penyimpanan, kapasitas, spesifikasi teknis, dll"></textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="index.php?role=admin&controller=RuangPenyimpanan&action=index" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Ruang
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
                                    Nama ruang wajib diisi
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Lokasi harus dipilih
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Keterangan untuk detail ruang
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Ruang akan langsung tersimpan
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Storage Types -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5><i class="fas fa-database me-2"></i>Jenis Penyimpanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="tech-feature">
                                <strong>Server Room:</strong><br>
                                <small class="text-muted">Penyimpanan fisik di server lokal</small>
                            </div>
                            <div class="tech-feature">
                                <strong>Data Center:</strong><br>
                                <small class="text-muted">Pusat data dengan redundansi</small>
                            </div>
                            <div class="tech-feature">
                                <strong>Cloud Storage:</strong><br>
                                <small class="text-muted">Penyimpanan awan dengan backup</small>
                            </div>
                            <div class="tech-feature">
                                <strong>Backup Center:</strong><br>
                                <small class="text-muted">Cadangan data untuk keamanan</small>
                            </div>
                        </div>
                    </div>

                    <!-- Tech Specs -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5><i class="fas fa-microchip me-2"></i>Spesifikasi Teknis</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="storage-icon mx-auto">
                                    <i class="fas fa-server"></i>
                                </div>
                                <h6>Storage Unit</h6>
                            </div>
                            <div class="mb-2">
                                <strong>Kapasitas:</strong><br>
                                <small class="text-muted">1TB - 10TB per unit</small>
                            </div>
                            <div class="mb-2">
                                <strong>Keamanan:</strong><br>
                                <small class="text-muted">Encryption & Access Control</small>
                            </div>
                            <div class="mb-2">
                                <strong>Backup:</strong><br>
                                <small class="text-muted">Daily & Weekly backup</small>
                            </div>
                            <div class="mb-2">
                                <strong>Monitoring:</strong><br>
                                <small class="text-muted">24/7 system monitoring</small>
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