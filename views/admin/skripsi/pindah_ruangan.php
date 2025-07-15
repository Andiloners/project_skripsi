<!DOCTYPE html>
<html>
<head>
    <title>Pindah Ruangan Skripsi</title>
</head>
<body>
    <h1>Pindah Ruangan Skripsi</h1>
    <?php
    require_once __DIR__ . '/../../../models/Skripsi.php';
    $skripsiModel = new Skripsi($conn);
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $skripsi = $skripsiModel->getById($id);
    if (!$skripsi) {
        echo '<p>Skripsi tidak ditemukan.</p>';
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Misal: update kolom ruang_penyimpanan_id
        $ruang_id = $_POST['ruang_penyimpanan_id'];
        $sql = "UPDATE skripsi SET ruang_penyimpanan_id = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $ruang_id, $id);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            echo '<p>Berhasil memindahkan skripsi. <a href="?role=admin&page=skripsi&subpage=list">Kembali ke daftar</a></p>';
        } else {
            echo '<p>Gagal memindahkan skripsi.</p>';
        }
    }
    ?>
    <form method="post" action="">
        <label>ID Ruang Penyimpanan Baru:</label><br>
        <input type="text" name="ruang_penyimpanan_id" required><br><br>
        <button type="submit">Pindahkan</button>
    </form>
</body>
</html>
