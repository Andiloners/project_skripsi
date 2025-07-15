<?php
// Konfigurasi database
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'db_skripsi';

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db_name);

// Cek koneksi
if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Load class Database dan Auth
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Auth.php';

// Inisialisasi class
$db = new Database();
$auth = new Auth();
?>
