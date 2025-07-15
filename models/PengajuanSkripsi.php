<?php
require_once __DIR__ . '/../config/config.php';

class PengajuanSkripsi {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Ambil semua pengajuan skripsi
    public function getAll() {
        $sql = "SELECT * FROM pengajuan_skripsi";
        $result = mysqli_query($this->conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil pengajuan skripsi berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM pengajuan_skripsi WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Tambah pengajuan skripsi
    public function create($mahasiswa_nama, $judul, $tanggal, $status) {
        $sql = "INSERT INTO pengajuan_skripsi (mahasiswa_nama, judul, tanggal, status) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $mahasiswa_nama, $judul, $tanggal, $status);
        return mysqli_stmt_execute($stmt);
    }

    // Update pengajuan skripsi
    public function update($id, $mahasiswa_nama, $judul, $tanggal, $status) {
        $sql = "UPDATE pengajuan_skripsi SET mahasiswa_nama = ?, judul = ?, tanggal = ?, status = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $mahasiswa_nama, $judul, $tanggal, $status, $id);
        return mysqli_stmt_execute($stmt);
    }

    // Hapus pengajuan skripsi
    public function delete($id) {
        $sql = "DELETE FROM pengajuan_skripsi WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }
}