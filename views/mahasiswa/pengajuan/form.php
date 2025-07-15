<!DOCTYPE html>
<html>
<head>
    <title>Form Pengajuan Skripsi</title>
</head>
<body>
    <h1>Form Pengajuan Skripsi</h1>
    <form method="post" action="?role=mahasiswa&page=pengajuan&subpage=form">
        <label>Judul Skripsi:</label><br>
        <input type="text" name="judul" required><br>
        <label>Tanggal Pengajuan:</label><br>
        <input type="date" name="tanggal" required><br>
        <label>Status:</label><br>
        <input type="text" name="status" value="Menunggu" readonly><br><br>
        <button type="submit">Ajukan</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Simulasi penyimpanan data, integrasi dengan model jika sudah ada
        echo '<p>Pengajuan skripsi berhasil dikirim!</p>';
    }
    ?>
</body>
</html>
