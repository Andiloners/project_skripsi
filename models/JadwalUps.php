<?php
require_once __DIR__ . '/../config/config.php';

class JadwalUps {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Ambil semua jadwal UPS
    public function getAll() {
        $sql = "SELECT * FROM jadwal_ups";
        $result = mysqli_query($this->conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil jadwal UPS berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM jadwal_ups WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Tambah jadwal UPS
    public function create($tanggal, $waktu, $ruangan, $keterangan) {
        $sql = "INSERT INTO jadwal_ups (tanggal, waktu, ruangan, keterangan) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $tanggal, $waktu, $ruangan, $keterangan);
        return mysqli_stmt_execute($stmt);
    }

    // Update jadwal UPS
    public function update($id, $tanggal, $waktu, $ruangan, $keterangan) {
        $sql = "UPDATE jadwal_ups SET tanggal = ?, waktu = ?, ruangan = ?, keterangan = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $tanggal, $waktu, $ruangan, $keterangan, $id);
        return mysqli_stmt_execute($stmt);
    }

    // Hapus jadwal UPS
    public function delete($id) {
        $sql = "DELETE FROM jadwal_ups WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }
}
