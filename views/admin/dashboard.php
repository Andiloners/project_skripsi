<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #ff4e50 0%, #f9d423 100%); /* Merah ke Kuning */
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
            position: relative;
            /* Watermark logo samar */
            background-image: url('assets/images/image.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 550px 550px;
            opacity: 1;
        }
        .main-content:before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: inherit;
            background-image: inherit;
            background-repeat: inherit;
            background-position: inherit;
            background-size: inherit;
            opacity: 0.045; /* Lebih samar */
            pointer-events: none;
            z-index: 1;
        }
        .main-content > * {
            position: relative;
            z-index: 2;
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
            background: linear-gradient(135deg, #ff4e50 0%, #ff7675 100%); /* Merah */
        }
        .bg-success-gradient {
            background: linear-gradient(135deg, #f9d423 0%, #f9ca24 100%); /* Kuning */
        }
        .bg-warning-gradient {
            background: linear-gradient(135deg, #00b894 0%, #00cec9 100%); /* Hijau */
        }
        .bg-info-gradient {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); /* Tetap biru */
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
                        <img src="assets/images/image.png" alt="Logo" style="width:90px; height:90px; object-fit:contain; margin-bottom:15px;">
                        <h4 style="margin-top:10px;"><i class="fas fa-graduation-cap"></i> Admin Panel</h4>
                        <small>Sistem Manajemen Skripsi</small>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="index.php?role=admin&controller=Dashboard&action=index">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a class="nav-link" href="index.php?role=admin&controller=Dosen&action=index">
                            <i class="fas fa-user-tie me-2"></i> Dosen
                        </a>
                        <a class="nav-link" href="index.php?role=admin&controller=Mahasiswa&action=index">
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
                            <h4 class="mb-0">Dashboard</h4>
                            <div class="navbar-nav ms-auto">
                                <span class="navbar-text">
                                    <i class="fas fa-user me-2"></i>
                                    Selamat datang, andiloners_058!
                                </span>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Content -->
                    <div class="p-4">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2>Statistik Sistem</h2>
                                <p class="text-muted">Ringkasan data sistem manajemen skripsi</p>
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
                                                <div class="stats-icon bg-info-gradient float-end">
                                                    <i class="fas fa-file-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Pengajuan</h5>
                                                <span class="h2 font-weight-bold mb-0"><?php echo $totalPengajuan; ?></span>
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
                                                <a href="index.php?role=admin&controller=Dosen&action=tambah" class="btn btn-primary w-100">
                                                    <i class="fas fa-plus me-2"></i>Tambah Dosen
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <a href="index.php?role=admin&controller=Mahasiswa&action=tambah" class="btn btn-success w-100">
                                                    <i class="fas fa-plus me-2"></i>Tambah Mahasiswa
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <a href="index.php?role=admin&controller=JadwalUps&action=tambah" class="btn btn-warning w-100">
                                                    <i class="fas fa-plus me-2"></i>Tambah Jadwal
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <a href="index.php?role=admin&controller=RuangPenyimpanan&action=tambah" class="btn btn-info w-100">
                                                    <i class="fas fa-plus me-2"></i>Tambah Ruang
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
