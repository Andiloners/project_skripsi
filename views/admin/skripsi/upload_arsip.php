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
    <title>Upload Arsip Skripsi - Admin Dashboard</title>
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
        .upload-area {
            border: 2px dashed #667eea;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            border-color: #764ba2;
            background: #e9ecef;
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
        .file-info {
            background: #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2><i class="fas fa-upload me-2"></i>Upload Arsip Skripsi</h2>
                        <p class="mb-0">Upload file arsip skripsi mahasiswa</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="index.php?role=admin&controller=Skripsi&action=index" class="btn btn-light me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="index.php?role=admin&controller=Skripsi&action=detail&id=<?php echo $skripsi['id']; ?>" class="btn btn-info">
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
                    <!-- Form Upload -->
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-file-upload me-2"></i>Upload File Arsip</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="upload-area">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                    <h5>Pilih File Arsip</h5>
                                    <p class="text-muted">Drag and drop file PDF atau klik untuk memilih</p>
                                    <input type="file" name="file_arsip" class="form-control" accept=".pdf,.doc,.docx" required>
                                    <div class="file-info">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Format yang didukung: PDF, DOC, DOCX (Maksimal 10MB)
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-upload me-2"></i>Upload Arsip
                                    </button>
                                    <a href="index.php?role=admin&controller=Skripsi&action=index" class="btn btn-secondary ms-2">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Informasi Skripsi -->
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-info-circle me-2"></i>Informasi Skripsi</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="text-primary"><?php echo htmlspecialchars($skripsi['judul']); ?></h6>
                            <hr>
                            <p><strong>Mahasiswa:</strong><br>
                               <?php echo htmlspecialchars($skripsi['mahasiswa_nama'] ?? 'N/A'); ?></p>
                            <p><strong>Tahun:</strong><br>
                               <span class="badge bg-info"><?php echo htmlspecialchars($skripsi['tahun']); ?></span></p>
                            
                            <?php if ($skripsi['file_arsip']): ?>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Perhatian:</strong> File arsip sudah ada. Upload file baru akan menggantikan file yang lama.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Petunjuk -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5><i class="fas fa-question-circle me-2"></i>Petunjuk</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>File harus dalam format PDF, DOC, atau DOCX</li>
                                <li><i class="fas fa-check text-success me-2"></i>Ukuran file maksimal 10MB</li>
                                <li><i class="fas fa-check text-success me-2"></i>Nama file akan otomatis diubah untuk keamanan</li>
                                <li><i class="fas fa-check text-success me-2"></i>File akan disimpan di folder uploads</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
