<!DOCTYPE html>
<html>
<head>
    <title>Skripsi Tersimpan</title>
</head>
<body>
    <?php include 'layout.php'; ?>
    <h1>Skripsi Tersimpan</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Mahasiswa</th>
            <th>Dosen</th>
            <th>Tahun</th>
            <th>File Arsip</th>
        </tr>
        <?php
        require_once __DIR__ . '/../../models/Skripsi.php';
        $skripsiModel = new Skripsi($conn);
        $data = $skripsiModel->getAll();
        $no = 1;
        foreach ($data as $skripsi) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . htmlspecialchars($skripsi['judul']) . '</td>';
            echo '<td>' . htmlspecialchars($skripsi['mahasiswa_id']) . '</td>';
            echo '<td>' . htmlspecialchars($skripsi['dosen_id']) . '</td>';
            echo '<td>' . htmlspecialchars($skripsi['tahun']) . '</td>';
            echo '<td>' . htmlspecialchars($skripsi['file_arsip']) . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>
