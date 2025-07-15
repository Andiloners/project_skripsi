<!DOCTYPE html>
<html>
<head>
    <title>Simpan Skripsi Baru</title>
</head>
<body>
    <h1>Simpan Skripsi Baru</h1>
    <form method="post" action="?role=admin&page=skripsi&subpage=simpan_baru">
        <label>Judul:</label><br>
        <input type="text" name="judul" required><br>
        <label>ID Mahasiswa:</label><br>
        <input type="text" name="mahasiswa_id" required><br>
        <label>ID Dosen:</label><br>
        <input type="text" name="dosen_id" required><br>
        <label>Tahun:</label><br>
        <input type="text" name="tahun" required><br>
        <label>File Arsip:</label><br>
        <input type="text" name="file_arsip"><br><br>
        <button type="submit">Simpan</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/../../../models/Skripsi.php';
        $skripsiModel = new Skripsi($conn);
        $result = $skripsiModel->create($_POST['judul'], $_POST['mahasiswa_id'], $_POST['dosen_id'], $_POST['tahun'], $_POST['file_arsip']);
        if ($result) {
            echo '<p>Berhasil menyimpan skripsi. <a href="?role=admin&page=skripsi&subpage=list">Kembali ke daftar</a></p>';
        } else {
            echo '<p>Gagal menyimpan skripsi.</p>';
        }
    }
    ?>
</body>
</html>
