<!DOCTYPE html>
<html>
<head>
    <title>Detail Pengajuan Skripsi</title>
</head>
<body>
    <h1>Detail Pengajuan Skripsi</h1>
    <?php
    require_once __DIR__ . '/../../../models/PengajuanSkripsi.php';
    $pengajuanModel = new PengajuanSkripsi($conn);
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $pengajuan = $pengajuanModel->getById($id);
    if (!$pengajuan) {
        echo '<p>Pengajuan tidak ditemukan.</p>';
        exit;
    }
    echo '<p><strong>Nama Mahasiswa:</strong> ' . htmlspecialchars($pengajuan['mahasiswa_nama']) . '</p>';
    echo '<p><strong>Judul:</strong> ' . htmlspecialchars($pengajuan['judul']) . '</p>';
    echo '<p><strong>Tanggal:</strong> ' . htmlspecialchars($pengajuan['tanggal']) . '</p>';
    echo '<p><strong>Status:</strong> ' . htmlspecialchars($pengajuan['status']) . '</p>';
    ?>
    <a href="?role=dosen&page=pengajuan_skripsi&subpage=daftar">Kembali ke daftar</a>
</body>
</html>
