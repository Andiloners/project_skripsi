<!DOCTYPE html>
<html>
<head>
    <title>Semua Jadwal UPS</title>
</head>
<body>
    <h1>Semua Jadwal UPS</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Ruangan</th>
            <th>Keterangan</th>
        </tr>
        <?php
        require_once __DIR__ . '/../../../models/JadwalUps.php';
        $jadwalModel = new JadwalUps($conn);
        $data = $jadwalModel->getAll();
        $no = 1;
        foreach ($data as $jadwal) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . htmlspecialchars($jadwal['tanggal']) . '</td>';
            echo '<td>' . htmlspecialchars($jadwal['waktu']) . '</td>';
            echo '<td>' . htmlspecialchars($jadwal['ruangan']) . '</td>';
            echo '<td>' . htmlspecialchars($jadwal['keterangan']) . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>
