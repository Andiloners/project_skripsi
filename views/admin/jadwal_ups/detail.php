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
    <title>Detail Jadwal UPS - Admin Dashboard</title>
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
        .time-display {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-calendar-alt me-2"></i>Detail Jadwal UPS</h2>
                        <p class="mb-0">Informasi lengkap jadwal ujian pendadaran</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=JadwalUps&action=index" class="btn btn-light me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="index.php?role=admin&controller=JadwalUps&action=edit&id=<?php echo $jadwal['id']; ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <!-- Time Display -->
                    <div class="time-display">
                        <h3><i class="fas fa-clock me-2"></i><?php echo date('H:i', strtotime($jadwal['waktu'])); ?></h3>
                        <p class="mb-0"><?php echo date('l, d F Y', strtotime($jadwal['tanggal'])); ?></p>
                    </div>

                    <!-- Informasi Utama -->
                    <div class="info-card">
                        <h4><i class="fas fa-info-circle me-2 text-primary"></i>Informasi Jadwal</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-primary"><?php echo htmlspecialchars($jadwal['keterangan']); ?></h5>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-calendar me-2"></i>
                                    Jadwal Ujian Pendadaran Skripsi
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Ruangan -->
                    <div class="info-card">
                        <h4><i class="fas fa-map-marker-alt me-2 text-success"></i>Informasi Ruangan</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Ruangan:</strong> <?php echo htmlspecialchars($jadwal['ruangan']); ?></p>
                                <p><strong>Kapasitas:</strong> 
                                    <?php
                                    $kapasitas = '';
                                    switch ($jadwal['ruangan']) {
                                        case 'Ruang Sidang A':
                                            $kapasitas = '50 orang';
                                            break;
                                        case 'Ruang Sidang B':
                                            $kapasitas = '30 orang';
                                            break;
                                        case 'Ruang Sidang C':
                                            $kapasitas = '20 orang';
                                            break;
                                        case 'Aula Fakultas':
                                            $kapasitas = '100 orang';
                                            break;
                                        default:
                                            $kapasitas = 'Tidak diketahui';
                                    }
                                    echo $kapasitas;
                                    ?>
                                </p>
                                <p><strong>Fasilitas:</strong> Proyektor, Papan Tulis, Sound System</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Jadwal -->
                    <div class="info-card">
                        <h4><i class="fas fa-tasks me-2 text-warning"></i>Status Jadwal</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $tanggal_jadwal = strtotime($jadwal['tanggal']);
                                $tanggal_sekarang = strtotime(date('Y-m-d'));
                                
                                if ($tanggal_jadwal < $tanggal_sekarang) {
                                    $status = 'Selesai';
                                    $badgeClass = 'bg-secondary';
                                    $icon = 'fas fa-check-circle';
                                    $description = 'Jadwal UPS telah selesai dilaksanakan.';
                                } elseif ($tanggal_jadwal == $tanggal_sekarang) {
                                    $status = 'Hari Ini';
                                    $badgeClass = 'bg-warning';
                                    $icon = 'fas fa-clock';
                                    $description = 'Jadwal UPS akan dilaksanakan hari ini.';
                                } else {
                                    $status = 'Mendatang';
                                    $badgeClass = 'bg-success';
                                    $icon = 'fas fa-calendar-check';
                                    $description = 'Jadwal UPS akan dilaksanakan di masa mendatang.';
                                }
                                ?>
                                <div class="text-center">
                                    <span class="badge <?php echo $badgeClass; ?> fs-6">
                                        <i class="<?php echo $icon; ?> me-2"></i>
                                        <?php echo $status; ?>
                                    </span>
                                    <p class="mt-3 text-muted"><?php echo $description; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- ID Jadwal -->
                    <div class="info-card">
                        <h4><i class="fas fa-hashtag me-2 text-info"></i>ID Jadwal</h4>
                        <hr>
                        <div class="text-center">
                            <span class="badge bg-secondary fs-4">#<?php echo $jadwal['id']; ?></span>
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
                                    <small class="text-muted">Jadwal dibuat</small>
                                    <p class="mb-0">Sistem mencatat jadwal baru</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-<?php echo $tanggal_jadwal < $tanggal_sekarang ? 'secondary' : ($tanggal_jadwal == $tanggal_sekarang ? 'warning' : 'success'); ?>"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">Status saat ini</small>
                                    <p class="mb-0"><?php echo $status; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="info-card">
                        <h4><i class="fas fa-cogs me-2 text-secondary"></i>Aksi</h4>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="index.php?role=admin&controller=JadwalUps&action=edit&id=<?php echo $jadwal['id']; ?>" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-2"></i>Edit Jadwal
                            </a>
                            <a href="index.php?role=admin&controller=JadwalUps&action=hapus&id=<?php echo $jadwal['id']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                <i class="fas fa-trash me-2"></i>Hapus Jadwal
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