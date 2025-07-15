<?php
require_once __DIR__ . '/../../../models/Skripsi.php';
$skripsiModel = new Skripsi($conn);
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$skripsi = $skripsiModel->getById($id);
if ($skripsi) {
    $result = $skripsiModel->update($id, $skripsi['judul'], $skripsi['mahasiswa_id'], $skripsi['dosen_id'], $skripsi['tahun'], '');
    if ($result) {
        echo '<p>Berhasil menghapus arsip. <a href="?role=admin&page=skripsi&subpage=list">Kembali ke daftar</a></p>';
    } else {
        echo '<p>Gagal menghapus arsip.</p>';
    }
} else {
    echo '<p>Skripsi tidak ditemukan.</p>';
}
?>
