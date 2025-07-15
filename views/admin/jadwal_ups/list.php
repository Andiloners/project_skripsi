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
    <title>Daftar Jadwal UPS - Admin Dashboard</title>
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
        .schedule-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }
        .schedule-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .time-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2><i class="fas fa-calendar-alt me-2"></i>Daftar Jadwal UPS</h2>
                        <p class="mb-0">Kelola jadwal ujian pendadaran skripsi</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="index.php?role=admin&controller=JadwalUps&action=tambah" class="btn btn-light">
                            <i class="fas fa-plus me-2"></i>Tambah Jadwal UPS
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

            <!-- Tampilan Card untuk Mobile -->
            <div class="d-md-none">
                <?php if (isset($jadwal) && is_array($jadwal) && count($jadwal) > 0): ?>
                    <?php foreach ($jadwal as $item): ?>
                        <div class="schedule-card">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="text-primary mb-0">
                                    <i class="fas fa-calendar me-2"></i>
                                    <?php echo date('d/m/Y', strtotime($item['tanggal'])); ?>
                                </h6>
                                <span class="time-badge">
                                    <i class="fas fa-clock me-1"></i>
                                    <?php echo date('H:i', strtotime($item['waktu'])); ?>
                                </span>
                            </div>
                            <p class="mb-2">
                                <i class="fas fa-map-marker-alt me-2 text-success"></i>
                                <strong><?php echo htmlspecialchars($item['ruangan']); ?></strong>
                            </p>
                            <p class="mb-3 text-muted">
                                <i class="fas fa-info-circle me-2"></i>
                                <?php echo htmlspecialchars($item['keterangan']); ?>
                            </p>
                            <div class="action-buttons">
                                <a href="index.php?role=admin&controller=JadwalUps&action=edit&id=<?php echo $item['id']; ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <a href="index.php?role=admin&controller=JadwalUps&action=hapus&id=<?php echo $item['id']; ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-4">
                        <div class="text-muted">
                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                            <h5>Belum ada jadwal UPS</h5>
                            <p>Silakan tambahkan jadwal baru untuk memulai</p>
                            <a href="index.php?role=admin&controller=JadwalUps&action=tambah" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah Jadwal
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tampilan Table untuk Desktop -->
            <div class="d-none d-md-block">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Tanggal</th>
                                <th width="10%">Waktu</th>
                                <th width="20%">Ruangan</th>
                                <th width="35%">Keterangan</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($jadwal) && is_array($jadwal) && count($jadwal) > 0): ?>
                                <?php $no = 1; foreach ($jadwal as $item): ?>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge bg-primary"><?php echo $no++; ?></span>
                                        </td>
                                        <td>
                                            <i class="fas fa-calendar me-2 text-primary"></i>
                                            <?php echo date('d/m/Y', strtotime($item['tanggal'])); ?>
                                        </td>
                                        <td>
                                            <span class="time-badge">
                                                <i class="fas fa-clock me-1"></i>
                                                <?php echo date('H:i', strtotime($item['waktu'])); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <i class="fas fa-map-marker-alt me-2 text-success"></i>
                                            <strong><?php echo htmlspecialchars($item['ruangan']); ?></strong>
                                        </td>
                                        <td>
                                            <i class="fas fa-info-circle me-2 text-info"></i>
                                            <?php echo htmlspecialchars($item['keterangan']); ?>
                                        </td>
                                        <td class="action-buttons">
                                            <a href="index.php?role=admin&controller=JadwalUps&action=edit&id=<?php echo $item['id']; ?>" 
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="index.php?role=admin&controller=JadwalUps&action=hapus&id=<?php echo $item['id']; ?>" 
                                               class="btn btn-sm btn-danger" title="Hapus"
                                               onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                            <h5>Belum ada jadwal UPS</h5>
                                            <p>Silakan tambahkan jadwal baru untuk memulai</p>
                                            <a href="index.php?role=admin&controller=JadwalUps&action=tambah" class="btn btn-primary">
                                                <i class="fas fa-plus me-2"></i>Tambah Jadwal
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if (isset($jadwal) && is_array($jadwal) && count($jadwal) > 0): ?>
                <!-- Statistik -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-calendar-check fa-2x mb-2"></i>
                                <h4><?php echo count($jadwal); ?></h4>
                                <small>Total Jadwal</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <h4><?php echo count(array_filter($jadwal, function($item) { 
                                    return strtotime($item['tanggal']) >= strtotime(date('Y-m-d')); 
                                })); ?></h4>
                                <small>Jadwal Mendatang</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-calendar-day fa-2x mb-2"></i>
                                <h4><?php echo count(array_filter($jadwal, function($item) { 
                                    return $item['tanggal'] == date('Y-m-d'); 
                                })); ?></h4>
                                <small>Hari Ini</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marker-alt fa-2x mb-2"></i>
                                <h4><?php echo count(array_unique(array_column($jadwal, 'ruangan'))); ?></h4>
                                <small>Ruangan Aktif</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <p class="text-muted">
                            <i class="fas fa-info-circle me-2"></i>
                            Total: <strong><?php echo count($jadwal); ?></strong> jadwal UPS
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
