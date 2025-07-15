<?php
require_once __DIR__ . '/../../../models/PengajuanSkripsi.php';
$pengajuanModel = new PengajuanSkripsi($conn);
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id) {
    $result = $pengajuanModel->delete($id);
    if ($result) {
        echo '<p>Berhasil menghapus pengajuan. <a href="?role=admin&page=pengajuan_skripsi&subpage=list">Kembali ke daftar</a></p>';
    } else {
        echo '<p>Gagal menghapus pengajuan.</p>';
    }
} else {
    echo '<p>ID pengajuan tidak valid.</p>';
}
?>
