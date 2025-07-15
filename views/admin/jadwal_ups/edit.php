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
    <title>Edit Jadwal UPS - Admin Dashboard</title>
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
                        <h2><i class="fas fa-edit me-2"></i>Edit Jadwal UPS</h2>
                        <p class="mb-0">Edit jadwal ujian pendadaran skripsi</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=JadwalUps&action=index" class="btn btn-light me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="index.php?role=admin&controller=JadwalUps&action=detail&id=<?php echo $jadwal['id']; ?>" class="btn btn-info">
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
                            <h5><i class="fas fa-edit me-2"></i>Form Edit Jadwal UPS</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal" class="form-label">
                                            <i class="fas fa-calendar me-2"></i>Tanggal UPS
                                        </label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" 
                                               value="<?php echo htmlspecialchars($jadwal['tanggal']); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="waktu" class="form-label">
                                            <i class="fas fa-clock me-2"></i>Waktu UPS
                                        </label>
                                        <input type="time" class="form-control" id="waktu" name="waktu" 
                                               value="<?php echo htmlspecialchars($jadwal['waktu']); ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="ruangan" class="form-label">
                                            <i class="fas fa-map-marker-alt me-2"></i>Ruangan
                                        </label>
                                        <select class="form-select" id="ruangan" name="ruangan" required>
                                            <option value="">Pilih Ruangan</option>
                                            <option value="Ruang Sidang A" <?php echo ($jadwal['ruangan'] == 'Ruang Sidang A') ? 'selected' : ''; ?>>Ruang Sidang A</option>
                                            <option value="Ruang Sidang B" <?php echo ($jadwal['ruangan'] == 'Ruang Sidang B') ? 'selected' : ''; ?>>Ruang Sidang B</option>
                                            <option value="Ruang Sidang C" <?php echo ($jadwal['ruangan'] == 'Ruang Sidang C') ? 'selected' : ''; ?>>Ruang Sidang C</option>
                                            <option value="Ruang Seminar 1" <?php echo ($jadwal['ruangan'] == 'Ruang Seminar 1') ? 'selected' : ''; ?>>Ruang Seminar 1</option>
                                            <option value="Ruang Seminar 2" <?php echo ($jadwal['ruangan'] == 'Ruang Seminar 2') ? 'selected' : ''; ?>>Ruang Seminar 2</option>
                                            <option value="Aula Fakultas" <?php echo ($jadwal['ruangan'] == 'Aula Fakultas') ? 'selected' : ''; ?>>Aula Fakultas</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="keterangan" class="form-label">
                                            <i class="fas fa-info-circle me-2"></i>Keterangan
                                        </label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" 
                                                  required><?php echo htmlspecialchars($jadwal['keterangan']); ?></textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="index.php?role=admin&controller=JadwalUps&action=index" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Jadwal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Informasi Jadwal -->
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-info-circle me-2"></i>Informasi Jadwal</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="text-primary"><?php echo htmlspecialchars($jadwal['keterangan']); ?></h6>
                            <hr>
                            <p><strong>ID Jadwal:</strong><br>
                               <span class="badge bg-secondary">#<?php echo $jadwal['id']; ?></span></p>
                            <p><strong>Tanggal:</strong><br>
                               <i class="fas fa-calendar me-2 text-primary"></i>
                               <?php echo date('d/m/Y', strtotime($jadwal['tanggal'])); ?></p>
                            <p><strong>Waktu:</strong><br>
                               <i class="fas fa-clock me-2 text-success"></i>
                               <?php echo date('H:i', strtotime($jadwal['waktu'])); ?></p>
                            <p><strong>Ruangan:</strong><br>
                               <i class="fas fa-map-marker-alt me-2 text-warning"></i>
                               <?php echo htmlspecialchars($jadwal['ruangan']); ?></p>
                        </div>
                    </div>

                    <!-- Aksi Cepat -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5><i class="fas fa-bolt me-2"></i>Aksi Cepat</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="index.php?role=admin&controller=JadwalUps&action=detail&id=<?php echo $jadwal['id']; ?>" 
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
