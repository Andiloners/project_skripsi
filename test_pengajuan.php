<?php
session_start();
require_once __DIR__ . '/config/config.php';

echo "<h2>Test Halaman Pengajuan Skripsi</h2>";

// Test koneksi database
if ($conn) {
    echo "<p style='color: green;'>✓ Koneksi database berhasil</p>";
} else {
    echo "<p style='color: red;'>✗ Koneksi database gagal</p>";
    exit;
}

// Test query pengajuan skripsi
$sql = "SELECT COUNT(*) as total FROM pengajuan_skripsi";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo "<p style='color: green;'>✓ Query pengajuan skripsi berhasil</p>";
    echo "<p>Total pengajuan: " . $row['total'] . "</p>";
} else {
    echo "<p style='color: red;'>✗ Query pengajuan skripsi gagal</p>";
}

// Test data pengajuan
$sql = "SELECT * FROM pengajuan_skripsi LIMIT 5";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<p style='color: green;'>✓ Data pengajuan ditemukan</p>";
    echo "<h3>Data Pengajuan:</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Mahasiswa</th><th>Judul</th><th>Tanggal</th><th>Status</th></tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['mahasiswa_nama']) . "</td>";
        echo "<td>" . htmlspecialchars($row['judul']) . "</td>";
        echo "<td>" . $row['tanggal'] . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: orange;'>⚠ Tidak ada data pengajuan</p>";
}

// Test dengan Database class
echo "<h3>Test dengan Database Class:</h3>";
if ($db) {
    $sql = "SELECT * FROM pengajuan_skripsi ORDER BY tanggal DESC";
    $result = $db->query($sql);
    $pengajuan = $db->fetchAll($result);
    
    if ($pengajuan) {
        echo "<p style='color: green;'>✓ Database class berfungsi</p>";
        echo "<p>Total pengajuan (Database class): " . count($pengajuan) . "</p>";
    } else {
        echo "<p style='color: orange;'>⚠ Tidak ada data pengajuan</p>";
    }
} else {
    echo "<p style='color: red;'>✗ Database class tidak tersedia</p>";
}

echo "<h3>Instruksi Test Halaman:</h3>";
echo "<p>1. Buka browser dan akses: <a href='index.php?role=admin&controller=PengajuanSkripsi&action=index'>Daftar Pengajuan</a></p>";
echo "<p>2. Pastikan login sebagai admin terlebih dahulu</p>";
echo "<p>3. Test fitur tambah, edit, dan hapus pengajuan</p>";
?> 