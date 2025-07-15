<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pengajuan Skripsi</title>
</head>
<body>
    <h1>Daftar Pengajuan Skripsi</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Mahasiswa</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php
        require_once __DIR__ . '/../../../models/PengajuanSkripsi.php';
        $pengajuanModel = new PengajuanSkripsi($conn);
        $data = $pengajuanModel->getAll();
        $no = 1;
        foreach ($data as $pengajuan) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . htmlspecialchars($pengajuan['mahasiswa_nama']) . '</td>';
            echo '<td>' . htmlspecialchars($pengajuan['judul']) . '</td>';
            echo '<td>' . htmlspecialchars($pengajuan['tanggal']) . '</td>';
            echo '<td>' . htmlspecialchars($pengajuan['status']) . '</td>';
            echo '<td>';
            echo '<a href="?role=dosen&page=pengajuan_skripsi&subpage=detail&id=' . $pengajuan['id'] . '">Detail</a>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>
