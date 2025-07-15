<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #fd79a8 0%, #a29bfe 50%, #d63031 100%); /* Pink ke Ungu ke Merah */
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
            background: rgba(162,155,254,0.15); /* Ungu muda transparan */
        }
        .sidebar .nav-link.active {
            background: rgba(214,48,49,0.2); /* Merah transparan */
            color: white;
        }
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
            position: relative;
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
            opacity: 0.045;
            pointer-events: none;
            z-index: 1;
        }
        .main-content > * {
            position: relative;
            z-index: 2;
        }
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card {
            background: rgba(255,255,255,0.7);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .table {
            background: rgba(255,255,255,0.7);
            border-radius: 10px;
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
                            <h4 class="mb-0">Daftar Mahasiswa</h4>
                            <div class="navbar-nav ms-auto">
                                <a href="index.php?role=admin&controller=Mahasiswa&action=tambah" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Mahasiswa
                                </a>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Content -->
                    <div class="p-4">
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i><?php echo htmlspecialchars($_GET['error']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>NIM</th>
                                                <th>Email</th>
                                                <th>Program Studi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($mahasiswa)): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data mahasiswa</td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($mahasiswa as $index => $row): ?>
                                                    <tr>
                                                        <td><?php echo $index + 1; ?></td>
                                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['nim']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['prodi']); ?></td>
                                                        <td>
                                                            <a href="index.php?role=admin&controller=Mahasiswa&action=edit&id=<?php echo $row['id']; ?>" 
                                                               class="btn btn-sm btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="index.php?role=admin&controller=Mahasiswa&action=hapus&id=<?php echo $row['id']; ?>" 
                                                               class="btn btn-sm btn-danger"
                                                               onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
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
