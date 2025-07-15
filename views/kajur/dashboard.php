<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kajur - Sistem Skripsi</title>
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
        .card-stats {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card-stats:hover {
            transform: translateY(-5px);
        }
        .card-stats .card-body {
            padding: 30px;
        }
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }
        .bg-primary-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .bg-success-gradient {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        .bg-warning-gradient {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .bg-info-gradient {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .bg-danger-gradient {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        }
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
                        <h4><i class="fas fa-user-shield"></i> Kajur Panel</h4>
                        <small>Sistem Manajemen Skripsi</small>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="index.php?role=kajur&controller=Dashboard&action=index">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a class="nav-link" href="index.php?role=kajur&controller=JadwalUps&action=index">
                            <i class="fas fa-calendar-alt me-2"></i> Jadwal UPS
                        </a>
                        <a class="nav-link" href="index.php?role=kajur&controller=PengajuanSkripsi&action=index">
                            <i class="fas fa-file-alt me-2"></i> Pengajuan Skripsi
                        </a>
                        <a class="nav-link" href="index.php?role=kajur&controller=SkripsiTersimpan&action=index">
                            <i class="fas fa-archive me-2"></i> Skripsi Tersimpan
                        </a>
                        <hr class="my-3">
                        <a class="nav-link" href="index.php?role=kajur&controller=Login&action=logout">
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
                            <h4 class="mb-0">Dashboard Kajur</h4>
                            <div class="navbar-nav ms-auto">
                                <span class="navbar-text">
                                    <i class="fas fa-user-shield me-2"></i>
                                    Selamat datang, Ketua Jurusan!
                                </span>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Content -->
                    <div class="p-4">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2>Statistik Jurusan</h2>
                                <p class="text-muted">Ringkasan data jurusan dan skripsi</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card card-stats">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="stats-icon bg-primary-gradient float-end">
                                                    <i class="fas fa-user-graduate"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Mahasiswa</h5>
                                                <span class="h2 font-weight-bold mb-0"><?php echo $totalMahasiswa; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card card-stats">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="stats-icon bg-success-gradient float-end">
                                                    <i class="fas fa-user-tie"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Dosen</h5>
                                                <span class="h2 font-weight-bold mb-0"><?php echo $totalDosen; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card card-stats">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="stats-icon bg-warning-gradient float-end">
                                                    <i class="fas fa-book"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Skripsi</h5>
                                                <span class="h2 font-weight-bold mb-0"><?php echo $totalSkripsi; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card card-stats">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="stats-icon bg-danger-gradient float-end">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Menunggu</h5>
                                                <span class="h2 font-weight-bold mb-0"><?php echo $pengajuanMenunggu; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Menu Cepat</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <a href="index.php?role=kajur&controller=JadwalUps&action=tambah" class="btn btn-primary w-100">
                                                    <i class="fas fa-plus me-2"></i>Tambah Jadwal UPS
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <a href="index.php?role=kajur&controller=PengajuanSkripsi&action=index" class="btn btn-warning w-100">
                                                    <i class="fas fa-file-alt me-2"></i>Review Pengajuan
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <a href="index.php?role=kajur&controller=SkripsiTersimpan&action=index" class="btn btn-success w-100">
                                                    <i class="fas fa-archive me-2"></i>Arsip Skripsi
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <a href="index.php?role=kajur&controller=Dashboard&action=index" class="btn btn-info w-100">
                                                    <i class="fas fa-chart-bar me-2"></i>Laporan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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
