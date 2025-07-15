<?php
require_once __DIR__ . '/../../../models/RuangPenyimpanan.php';
$ruangModel = new RuangPenyimpanan($conn);
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id) {
    $result = $ruangModel->delete($id);
    if ($result) {
        echo '<p>Berhasil menghapus ruang. <a href="?role=admin&page=ruang_penyimpanan&subpage=list">Kembali ke daftar</a></p>';
    } else {
        echo '<p>Gagal menghapus ruang.</p>';
    }
} else {
    echo '<p>ID ruang tidak valid.</p>';
}
?> 