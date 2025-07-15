<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
        }
        .btn-secondary {
            border-radius: 10px;
            padding: 12px 30px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar p-3">
                    <div class="text-center mb-4">
                        <h4><i class="fas fa-graduation-cap"></i> Admin Panel</h4>
                        <small>Sistem Manajemen Skripsi</small>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link" href="index.php?role=admin&controller=Dashboard&action=index">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a class="nav-link" href="index.php?role=admin&controller=Dosen&action=index">
                            <i class="fas fa-user-tie me-2"></i> Dosen
                        </a>
                        <a class="nav-link active" href="index.php?role=admin&controller=Mahasiswa&action=index">
                            <i class="fas fa-user-graduate me-2"></i> Mahasiswa
                        </a>
                        <a class="nav-link" href="index.php?role=admin&controller=Skripsi&action=index">
                            <i class="fas fa-book me-2"></i> Skripsi
                        </a>
                        <a class="nav-link" href="index.php?role=admin&controller=PengajuanSkripsi&action=index">
                            <i class="fas fa-file-alt me-2"></i> Pengajuan
                        </a>
                        <a class="nav-link" href="index.php?role=admin&controller=JadwalUps&action=index">
                            <i class="fas fa-calendar-alt me-2"></i> Jadwal UPS
                        </a>
                        <a class="nav-link" href="index.php?role=admin&controller=RuangPenyimpanan&action=index">
                            <i class="fas fa-warehouse me-2"></i> Ruang Penyimpanan
                        </a>
                        <hr class="my-3">
                        <a class="nav-link" href="index.php?role=admin&controller=Login&action=logout">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0">
                <div class="main-content">
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid">
                            <h4 class="mb-0">Tambah Mahasiswa</h4>
                            <div class="navbar-nav ms-auto">
                                <a href="index.php?role=admin&controller=Mahasiswa&action=index" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Content -->
                    <div class="p-4">
                        <div class="card">
                            <div class="card-body">
                                <?php if (isset($error) && $error): ?>
                                    <div class="alert alert-danger">
                                        <?php echo htmlspecialchars($error); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <form method="POST" action="index.php?role=admin&controller=Mahasiswa&action=tambah">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nim" class="form-label">NIM</label>
                                                <input type="text" class="form-control" id="nim" name="nim" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="prodi" class="form-label">Program Studi</label>
                                                <select class="form-control" id="prodi" name="prodi" required>
                                                    <option value="">Pilih Program Studi</option>
                                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                                    <option value="Teknik Komputer">Teknik Komputer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Simpan
                                        </button>
                                    </div>
                                </form>
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
