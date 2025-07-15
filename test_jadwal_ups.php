<?php
require_once 'config/config.php';

echo "<h2>Test Jadwal UPS</h2>";

// Test koneksi database
echo "<h3>1. Test Koneksi Database</h3>";
try {
    $sql = "SELECT COUNT(*) as total FROM jadwal_ups";
    $result = $db->query($sql);
    $data = $db->fetch($result);
    echo "✅ Koneksi database berhasil<br>";
    echo "Total jadwal UPS: " . $data['total'] . "<br><br>";
} catch (Exception $e) {
    echo "❌ Error koneksi database: " . $e->getMessage() . "<br><br>";
}

// Test tambah jadwal UPS
echo "<h3>2. Test Tambah Jadwal UPS</h3>";
try {
    $tanggal = date('Y-m-d', strtotime('+1 week'));
    $waktu = '09:00:00';
    $ruangan = 'Ruang Sidang A';
    $keterangan = 'Test Jadwal UPS - Mahasiswa Test';
    
    $sql = "INSERT INTO jadwal_ups (tanggal, waktu, ruangan, keterangan) VALUES ('$tanggal', '$waktu', '$ruangan', '$keterangan')";
    $result = $db->query($sql);
    
    if ($result) {
        $id = $db->lastInsertId();
        echo "✅ Berhasil menambah jadwal UPS dengan ID: $id<br>";
        echo "Tanggal: $tanggal<br>";
        echo "Waktu: $waktu<br>";
        echo "Ruangan: $ruangan<br>";
        echo "Keterangan: $keterangan<br><br>";
    } else {
        echo "❌ Gagal menambah jadwal UPS<br><br>";
    }
} catch (Exception $e) {
    echo "❌ Error menambah jadwal: " . $e->getMessage() . "<br><br>";
}

// Test ambil semua jadwal
echo "<h3>3. Test Ambil Semua Jadwal UPS</h3>";
try {
    $sql = "SELECT * FROM jadwal_ups ORDER BY tanggal DESC, waktu DESC LIMIT 5";
    $result = $db->query($sql);
    $jadwal_list = $db->fetchAll($result);
    
    if ($jadwal_list) {
        echo "✅ Berhasil mengambil " . count($jadwal_list) . " jadwal UPS terbaru:<br>";
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr><th>ID</th><th>Tanggal</th><th>Waktu</th><th>Ruangan</th><th>Keterangan</th></tr>";
        foreach ($jadwal_list as $jadwal) {
            echo "<tr>";
            echo "<td>" . $jadwal['id'] . "</td>";
            echo "<td>" . $jadwal['tanggal'] . "</td>";
            echo "<td>" . $jadwal['waktu'] . "</td>";
            echo "<td>" . $jadwal['ruangan'] . "</td>";
            echo "<td>" . $jadwal['keterangan'] . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        echo "❌ Tidak ada jadwal UPS<br><br>";
    }
} catch (Exception $e) {
    echo "❌ Error mengambil jadwal: " . $e->getMessage() . "<br><br>";
}

// Test update jadwal
echo "<h3>4. Test Update Jadwal UPS</h3>";
try {
    $sql = "SELECT id FROM jadwal_ups ORDER BY id DESC LIMIT 1";
    $result = $db->query($sql);
    $jadwal = $db->fetch($result);
    
    if ($jadwal) {
        $id = $jadwal['id'];
        $keterangan_baru = 'Test Jadwal UPS - Updated';
        
        $sql = "UPDATE jadwal_ups SET keterangan = '$keterangan_baru' WHERE id = $id";
        $result = $db->query($sql);
        
        if ($result) {
            echo "✅ Berhasil update jadwal UPS ID: $id<br>";
            echo "Keterangan baru: $keterangan_baru<br><br>";
        } else {
            echo "❌ Gagal update jadwal UPS<br><br>";
        }
    } else {
        echo "❌ Tidak ada jadwal untuk diupdate<br><br>";
    }
} catch (Exception $e) {
    echo "❌ Error update jadwal: " . $e->getMessage() . "<br><br>";
}

// Test hapus jadwal test
echo "<h3>5. Test Hapus Jadwal UPS Test</h3>";
try {
    $sql = "DELETE FROM jadwal_ups WHERE keterangan LIKE '%Test Jadwal UPS%'";
    $result = $db->query($sql);
    
    if ($result) {
        echo "✅ Berhasil menghapus jadwal UPS test<br><br>";
    } else {
        echo "❌ Gagal menghapus jadwal UPS test<br><br>";
    }
} catch (Exception $e) {
    echo "❌ Error hapus jadwal: " . $e->getMessage() . "<br><br>";
}

echo "<h3>6. Test Controller JadwalUps</h3>";
try {
    require_once 'controllers/admin/JadwalUpsController.php';
    $controller = new JadwalUpsController();
    echo "✅ Controller JadwalUps berhasil di-load<br><br>";
} catch (Exception $e) {
    echo "❌ Error load controller: " . $e->getMessage() . "<br><br>";
}

echo "<h3>7. Test View Files</h3>";
$view_files = [
    'views/admin/jadwal_ups/list.php',
    'views/admin/jadwal_ups/tambah.php',
    'views/admin/jadwal_ups/edit.php',
    'views/admin/jadwal_ups/detail.php'
];

foreach ($view_files as $file) {
    if (file_exists($file)) {
        echo "✅ File $file ada<br>";
    } else {
        echo "❌ File $file tidak ada<br>";
    }
}

echo "<br><h3>Test Selesai!</h3>";
echo "<a href='index.php?role=admin&controller=JadwalUps&action=index'>Klik di sini untuk melihat halaman Jadwal UPS</a>";
?> 