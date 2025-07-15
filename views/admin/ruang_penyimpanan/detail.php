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
    <title>Detail Ruang Penyimpanan - Admin Dashboard</title>
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
        .info-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #1e3c72;
        }
        .btn-primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
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
        .storage-display {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 30px;
        }
        .tech-spec {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            border-left: 3px solid #1e3c72;
        }
        .status-indicator {
            width: 12px;
            height: 12px;
            background: #28a745;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-server me-2"></i>Detail Ruang Penyimpanan</h2>
                        <p class="mb-0">Informasi lengkap ruang penyimpanan arsip skripsi</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=RuangPenyimpanan&action=index" class="btn btn-light me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="index.php?role=admin&controller=RuangPenyimpanan&action=edit&id=<?php echo $ruang['id']; ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <!-- Storage Display -->
                    <div class="storage-display">
                        <i class="fas fa-database fa-4x mb-3"></i>
                        <h3><?php echo htmlspecialchars($ruang['nama']); ?></h3>
                        <p class="mb-0">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <?php echo htmlspecialchars($ruang['lokasi']); ?>
                        </p>
                    </div>

                    <!-- Informasi Utama -->
                    <div class="info-card">
                        <h4><i class="fas fa-info-circle me-2 text-primary"></i>Informasi Ruang</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-primary"><?php echo htmlspecialchars($ruang['nama']); ?></h5>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-server me-2"></i>
                                    Ruang Penyimpanan Arsip Skripsi Digital
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Lokasi -->
                    <div class="info-card">
                        <h4><i class="fas fa-map-marker-alt me-2 text-success"></i>Informasi Lokasi</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Lokasi:</strong> <?php echo htmlspecialchars($ruang['lokasi']); ?></p>
                                <p><strong>Status Lokasi:</strong> 
                                    <span class="status-indicator"></span>
                                    <span class="text-success">Aktif</span>
                                </p>
                                <p><strong>Akses:</strong> 24/7 dengan sistem keamanan</p>
                                <p><strong>Fasilitas:</strong> AC, UPS, Fire Suppression System</p>
                            </div>
                        </div>
                    </div>

                    <!-- Spesifikasi Teknis -->
                    <div class="info-card">
                        <h4><i class="fas fa-microchip me-2 text-warning"></i>Spesifikasi Teknis</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tech-spec">
                                    <strong><i class="fas fa-hdd me-2"></i>Storage Capacity:</strong>
                                    <br>
                                    <small class="text-muted">1TB - 10TB per unit storage</small>
                                </div>
                                <div class="tech-spec">
                                    <strong><i class="fas fa-shield-alt me-2"></i>Security:</strong>
                                    <br>
                                    <small class="text-muted">AES-256 Encryption, Access Control, CCTV</small>
                                </div>
                                <div class="tech-spec">
                                    <strong><i class="fas fa-sync me-2"></i>Backup System:</strong>
                                    <br>
                                    <small class="text-muted">Daily backup, Weekly full backup, Offsite backup</small>
                                </div>
                                <div class="tech-spec">
                                    <strong><i class="fas fa-tachometer-alt me-2"></i>Performance:</strong>
                                    <br>
                                    <small class="text-muted">SSD Storage, RAID Configuration, High Availability</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- ID Ruang -->
                    <div class="info-card">
                        <h4><i class="fas fa-hashtag me-2 text-info"></i>ID Ruang</h4>
                        <hr>
                        <div class="text-center">
                            <span class="badge bg-secondary fs-4">#<?php echo $ruang['id']; ?></span>
                        </div>
                    </div>

                    <!-- Status Sistem -->
                    <div class="info-card">
                        <h4><i class="fas fa-chart-line me-2 text-secondary"></i>Status Sistem</h4>
                        <hr>
                        <div class="mb-3">
                            <strong>Storage Status:</strong><br>
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>Online
                            </span>
                        </div>
                        <div class="mb-3">
                            <strong>Capacity Usage:</strong><br>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" style="width: 65%"></div>
                            </div>
                            <small class="text-muted">65% terpakai</small>
                        </div>
                        <div class="mb-3">
                            <strong>Uptime:</strong><br>
                            <small class="text-muted">99.9% (30 hari terakhir)</small>
                        </div>
                        <div class="mb-3">
                            <strong>Last Backup:</strong><br>
                            <small class="text-muted">2 jam yang lalu</small>
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="info-card">
                        <h4><i class="fas fa-cogs me-2 text-secondary"></i>Aksi</h4>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="index.php?role=admin&controller=RuangPenyimpanan&action=edit&id=<?php echo $ruang['id']; ?>" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-2"></i>Edit Ruang
                            </a>
                            <a href="index.php?role=admin&controller=RuangPenyimpanan&action=hapus&id=<?php echo $ruang['id']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus ruang penyimpanan ini?')">
                                <i class="fas fa-trash me-2"></i>Hapus Ruang
                            </a>
                        </div>
                    </div>

                    <!-- Monitoring -->
                    <div class="info-card">
                        <h4><i class="fas fa-desktop me-2 text-secondary"></i>Monitoring</h4>
                        <hr>
                        <div class="mb-2">
                            <strong>CPU Usage:</strong><br>
                            <div class="progress mb-1">
                                <div class="progress-bar bg-info" style="width: 45%"></div>
                            </div>
                            <small class="text-muted">45%</small>
                        </div>
                        <div class="mb-2">
                            <strong>Memory Usage:</strong><br>
                            <div class="progress mb-1">
                                <div class="progress-bar bg-warning" style="width: 72%"></div>
                            </div>
                            <small class="text-muted">72%</small>
                        </div>
                        <div class="mb-2">
                            <strong>Network:</strong><br>
                            <div class="progress mb-1">
                                <div class="progress-bar bg-success" style="width: 30%"></div>
                            </div>
                            <small class="text-muted">30%</small>
                        </div>
                        <div class="mb-2">
                            <strong>Temperature:</strong><br>
                            <small class="text-muted">22°C (Normal)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 