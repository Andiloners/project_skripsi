<?php
require_once __DIR__ . '/../../../models/Dosen.php';
$dosenModel = new Dosen($conn);
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id) {
    $result = $dosenModel->delete($id);
    if ($result) {
        echo '<p>Berhasil menghapus dosen. <a href="?role=admin&page=dosen&subpage=list">Kembali ke daftar</a></p>';
    } else {
        echo '<p>Gagal menghapus dosen.</p>';
    }
} else {
    echo '<p>ID dosen tidak valid.</p>';
}
?>
