<?php
session_start();
require_once __DIR__ . '/config/config.php';

echo "<h2>Test Login Admin</h2>";

// Test koneksi database
if ($conn) {
    echo "<p style='color: green;'>✓ Koneksi database berhasil</p>";
} else {
    echo "<p style='color: red;'>✗ Koneksi database gagal</p>";
    exit;
}

// Test query user admin
$sql = "SELECT * FROM user WHERE username = 'zaky' AND role = 'admin'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    echo "<p style='color: green;'>✓ User admin ditemukan</p>";
    echo "<p>Username: " . $user['username'] . "</p>";
    echo "<p>Role: " . $user['role'] . "</p>";
    echo "<p>Password Hash: " . substr($user['password'], 0, 20) . "...</p>";
    
    // Test password verification
    $test_password = 'zky123';
    if (password_verify($test_password, $user['password'])) {
        echo "<p style='color: green;'>✓ Password verification berhasil</p>";
    } else {
        echo "<p style='color: red;'>✗ Password verification gagal</p>";
    }
} else {
    echo "<p style='color: red;'>✗ User admin tidak ditemukan</p>";
}

// Test login dengan Auth class
echo "<h3>Test Login dengan Auth Class</h3>";
if ($auth->login('zaky', 'zky123')) {
    echo "<p style='color: green;'>✓ Login berhasil dengan Auth class</p>";
    $current_user = $auth->getCurrentUser();
    echo "<p>Current User: " . json_encode($current_user) . "</p>";
    $auth->logout();
} else {
    echo "<p style='color: red;'>✗ Login gagal dengan Auth class</p>";
}

// Test login dengan password salah
if ($auth->login('zaky', 'password_salah')) {
    echo "<p style='color: red;'>✗ Login berhasil dengan password salah (seharusnya gagal)</p>";
} else {
    echo "<p style='color: green;'>✓ Login gagal dengan password salah (sesuai harapan)</p>";
}

// Test login dengan username yang tidak ada
if ($auth->login('user_tidak_ada', 'zky123')) {
    echo "<p style='color: red;'>✗ Login berhasil dengan username tidak ada (seharusnya gagal)</p>";
} else {
    echo "<p style='color: green;'>✓ Login gagal dengan username tidak ada (sesuai harapan)</p>";
}

echo "<h3>Instruksi Login Admin:</h3>";
echo "<p>1. Buka browser dan akses: <a href='index.php?role=admin&controller=Login&action=index'>Login Admin</a></p>";
echo "<p>2. Masukkan username: <strong>zaky</strong></p>";
echo "<p>3. Masukkan password: <strong>zky123</strong></p>";
echo "<p>4. Klik tombol Login</p>";
?> 