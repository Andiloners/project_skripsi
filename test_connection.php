<?php
echo "<h2>Test Koneksi Database</h2>";

// Test koneksi langsung
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'db_skripsi';

echo "<p>Mencoba koneksi ke database...</p>";
echo "<p>Host: $host</p>";
echo "<p>User: $user</p>";
echo "<p>Database: $db_name</p>";

try {
    $conn = mysqli_connect($host, $user, $pass, $db_name);
    
    if ($conn) {
        echo "<p style='color: green;'>✓ Koneksi database berhasil!</p>";
        
        // Test query
        $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM user");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo "<p>Total user dalam database: " . $row['total'] . "</p>";
        }
        
        mysqli_close($conn);
    } else {
        echo "<p style='color: red;'>✗ Koneksi database gagal: " . mysqli_connect_error() . "</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}

// Test dengan PDO
echo "<h3>Test dengan PDO</h3>";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
    echo "<p style='color: green;'>✓ Koneksi PDO berhasil!</p>";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM user");
    $row = $stmt->fetch();
    echo "<p>Total user (PDO): " . $row['total'] . "</p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ PDO Error: " . $e->getMessage() . "</p>";
}
?> 