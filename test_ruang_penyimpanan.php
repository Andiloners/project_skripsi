<?php
require_once 'config/config.php';

echo "<h2>Test Ruang Penyimpanan</h2>";

// Test koneksi database
echo "<h3>1. Test Koneksi Database</h3>";
try {
    $sql = "SELECT COUNT(*) as total FROM ruang_penyimpanan";
    $result = $db->query($sql);
    $data = $db->fetch($result);
    echo "✅ Koneksi database berhasil<br>";
    echo "Total ruang penyimpanan: " . $data['total'] . "<br><br>";
} catch (Exception $e) {
    echo "❌ Error koneksi database: " . $e->getMessage() . "<br><br>";
}

// Test tambah ruang penyimpanan
echo "<h3>2. Test Tambah Ruang Penyimpanan</h3>";
try {
    $nama = 'Server Room A';
    $lokasi = 'Gedung A - Lantai 1';
    $keterangan = 'Test Ruang Penyimpanan - Server lokal dengan kapasitas 5TB';
    
    $sql = "INSERT INTO ruang_penyimpanan (nama, lokasi, keterangan) VALUES ('$nama', '$lokasi', '$keterangan')";
    $result = $db->query($sql);
    
    if ($result) {
        $id = $db->lastInsertId();
        echo "✅ Berhasil menambah ruang penyimpanan dengan ID: $id<br>";
        echo "Nama: $nama<br>";
        echo "Lokasi: $lokasi<br>";
        echo "Keterangan: $keterangan<br><br>";
    } else {
        echo "❌ Gagal menambah ruang penyimpanan<br><br>";
    }
} catch (Exception $e) {
    echo "❌ Error menambah ruang: " . $e->getMessage() . "<br><br>";
}

// Test ambil semua ruang
echo "<h3>3. Test Ambil Semua Ruang Penyimpanan</h3>";
try {
    $sql = "SELECT * FROM ruang_penyimpanan ORDER BY id DESC LIMIT 5";
    $result = $db->query($sql);
    $ruang_list = $db->fetchAll($result);
    
    if ($ruang_list) {
        echo "✅ Berhasil mengambil " . count($ruang_list) . " ruang penyimpanan terbaru:<br>";
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr><th>ID</th><th>Nama</th><th>Lokasi</th><th>Keterangan</th></tr>";
        foreach ($ruang_list as $ruang) {
            echo "<tr>";
            echo "<td>" . $ruang['id'] . "</td>";
            echo "<td>" . $ruang['nama'] . "</td>";
            echo "<td>" . $ruang['lokasi'] . "</td>";
            echo "<td>" . $ruang['keterangan'] . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        echo "❌ Tidak ada ruang penyimpanan<br><br>";
    }
} catch (Exception $e) {
    echo "❌ Error mengambil ruang: " . $e->getMessage() . "<br><br>";
}

// Test update ruang
echo "<h3>4. Test Update Ruang Penyimpanan</h3>";
try {
    $sql = "SELECT id FROM ruang_penyimpanan ORDER BY id DESC LIMIT 1";
    $result = $db->query($sql);
    $ruang = $db->fetch($result);
    
    if ($ruang) {
        $id = $ruang['id'];
        $keterangan_baru = 'Test Ruang Penyimpanan - Updated dengan spesifikasi terbaru';
        
        $sql = "UPDATE ruang_penyimpanan SET keterangan = '$keterangan_baru' WHERE id = $id";
        $result = $db->query($sql);
        
        if ($result) {
            echo "✅ Berhasil update ruang penyimpanan ID: $id<br>";
            echo "Keterangan baru: $keterangan_baru<br><br>";
        } else {
            echo "❌ Gagal update ruang penyimpanan<br><br>";
        }
    } else {
        echo "❌ Tidak ada ruang untuk diupdate<br><br>";
    }
} catch (Exception $e) {
    echo "❌ Error update ruang: " . $e->getMessage() . "<br><br>";
}

// Test hapus ruang test
echo "<h3>5. Test Hapus Ruang Penyimpanan Test</h3>";
try {
    $sql = "DELETE FROM ruang_penyimpanan WHERE keterangan LIKE '%Test Ruang Penyimpanan%'";
    $result = $db->query($sql);
    
    if ($result) {
        echo "✅ Berhasil menghapus ruang penyimpanan test<br><br>";
    } else {
        echo "❌ Gagal menghapus ruang penyimpanan test<br><br>";
    }
} catch (Exception $e) {
    echo "❌ Error hapus ruang: " . $e->getMessage() . "<br><br>";
}

echo "<h3>6. Test Controller RuangPenyimpanan</h3>";
try {
    require_once 'controllers/admin/RuangPenyimpananController.php';
    $controller = new RuangPenyimpananController();
    echo "✅ Controller RuangPenyimpanan berhasil di-load<br><br>";
} catch (Exception $e) {
    echo "❌ Error load controller: " . $e->getMessage() . "<br><br>";
}

echo "<h3>7. Test View Files</h3>";
$view_files = [
    'views/admin/ruang_penyimpanan/list.php',
    'views/admin/ruang_penyimpanan/tambah.php',
    'views/admin/ruang_penyimpanan/edit.php',
    'views/admin/ruang_penyimpanan/detail.php'
];

foreach ($view_files as $file) {
    if (file_exists($file)) {
        echo "✅ File $file ada<br>";
    } else {
        echo "❌ File $file tidak ada<br>";
    }
}

echo "<br><h3>Test Selesai!</h3>";
echo "<a href='index.php?role=admin&controller=RuangPenyimpanan&action=index'>Klik di sini untuk melihat halaman Ruang Penyimpanan</a>";
?> 