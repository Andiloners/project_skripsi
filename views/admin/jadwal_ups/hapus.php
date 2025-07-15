<?php
require_once __DIR__ . '/../../../models/JadwalUps.php';
$jadwalModel = new JadwalUps($conn);
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id) {
    $result = $jadwalModel->delete($id);
    if ($result) {
        echo '<p>Berhasil menghapus jadwal. <a href="?role=admin&page=jadwal_ups&subpage=list">Kembali ke daftar</a></p>';
    } else {
        echo '<p>Gagal menghapus jadwal.</p>';
    }
} else {
    echo '<p>ID jadwal tidak valid.</p>';
}
?>
