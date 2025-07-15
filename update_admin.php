<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/models/User.php';

// Username dan password baru
$newUsername = 'andiloners_058';
$newPassword = 'admin123';
$oldUsername = 'zaky'; // Username admin lama (default)

$userModel = new User($conn);
$user = $userModel->getByUsername($oldUsername);

if ($user && $user['role'] === 'admin') {
    // Update username
    $userModel->update($user['id'], $newUsername, 'admin');
    // Update password
    $userModel->updatePassword($user['id'], $newPassword);
    echo "Username dan password admin berhasil diubah!<br>";
    echo "Username baru: <b>$newUsername</b><br>";
    echo "Password baru: <b>$newPassword</b><br>";
    $_SESSION['username'] = $newUsername;
} else {
    echo "User admin lama tidak ditemukan!<br>";
}

?>
