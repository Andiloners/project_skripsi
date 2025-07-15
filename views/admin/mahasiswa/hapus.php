<?php
require_once __DIR__ . '/../../../models/Mahasiswa.php';
$mahasiswaModel = new Mahasiswa($conn);
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id) {
    $result = $mahasiswaModel->delete($id);
    if ($result) {
        echo '<p>Berhasil menghapus mahasiswa. <a href="?role=admin&page=mahasiswa&subpage=list">Kembali ke daftar</a></p>';
    } else {
        echo '<p>Gagal menghapus mahasiswa.</p>';
    }
} else {
    echo '<p>ID mahasiswa tidak valid.</p>';
}
?>
