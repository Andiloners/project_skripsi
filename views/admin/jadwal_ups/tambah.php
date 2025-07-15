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
    <title>Tambah Jadwal UPS - Admin Dashboard</title>
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
        .time-slot {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            margin: 5px 0;
            border-left: 3px solid #667eea;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-plus-circle me-2"></i>Tambah Jadwal UPS</h2>
                        <p class="mb-0">Tambah jadwal ujian pendadaran skripsi baru</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=JadwalUps&action=index" class="btn btn-light">
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
                            <h5><i class="fas fa-edit me-2"></i>Form Jadwal UPS</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal" class="form-label">
                                            <i class="fas fa-calendar me-2"></i>Tanggal UPS
                                        </label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" 
                                               value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="waktu" class="form-label">
                                            <i class="fas fa-clock me-2"></i>Waktu UPS
                                        </label>
                                        <input type="time" class="form-control" id="waktu" name="waktu" 
                                               value="09:00" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="ruangan" class="form-label">
                                            <i class="fas fa-map-marker-alt me-2"></i>Ruangan
                                        </label>
                                        <select class="form-select" id="ruangan" name="ruangan" required>
                                            <option value="">Pilih Ruangan</option>
                                            <option value="Ruang Sidang A">Ruang Sidang A</option>
                                            <option value="Ruang Sidang B">Ruang Sidang B</option>
                                            <option value="Ruang Sidang C">Ruang Sidang C</option>
                                            <option value="Ruang Seminar 1">Ruang Seminar 1</option>
                                            <option value="Ruang Seminar 2">Ruang Seminar 2</option>
                                            <option value="Aula Fakultas">Aula Fakultas</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="keterangan" class="form-label">
                                            <i class="fas fa-info-circle me-2"></i>Keterangan
                                        </label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" 
                                                  placeholder="Masukkan keterangan jadwal UPS (nama mahasiswa, judul skripsi, dll)"></textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="index.php?role=admin&controller=JadwalUps&action=index" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Jadwal
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
                                    Tanggal dan waktu wajib diisi
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Ruangan harus dipilih
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Keterangan untuk detail jadwal
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Jadwal akan langsung tersimpan
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Time Slots -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5><i class="fas fa-clock me-2"></i>Time Slots Umum</h5>
                        </div>
                        <div class="card-body">
                            <div class="time-slot">
                                <strong>Pagi:</strong> 09:00 - 11:00
                            </div>
                            <div class="time-slot">
                                <strong>Siang:</strong> 13:00 - 15:00
                            </div>
                            <div class="time-slot">
                                <strong>Sore:</strong> 15:00 - 17:00
                            </div>
                        </div>
                    </div>

                    <!-- Ruangan Info -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5><i class="fas fa-map-marker-alt me-2"></i>Info Ruangan</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <strong>Ruang Sidang A:</strong><br>
                                <small class="text-muted">Kapasitas 50 orang</small>
                            </div>
                            <div class="mb-2">
                                <strong>Ruang Sidang B:</strong><br>
                                <small class="text-muted">Kapasitas 30 orang</small>
                            </div>
                            <div class="mb-2">
                                <strong>Ruang Sidang C:</strong><br>
                                <small class="text-muted">Kapasitas 20 orang</small>
                            </div>
                            <div class="mb-2">
                                <strong>Aula Fakultas:</strong><br>
                                <small class="text-muted">Kapasitas 100 orang</small>
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
