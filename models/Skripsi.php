<?php
require_once __DIR__ . '/../config/config.php';

class Skripsi {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Ambil semua skripsi
    public function getAll() {
        $sql = "SELECT * FROM skripsi";
        $result = mysqli_query($this->conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil skripsi berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM skripsi WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Tambah skripsi
    public function create($judul, $mahasiswa_id, $dosen_id, $tahun, $file_arsip) {
        $sql = "INSERT INTO skripsi (judul, mahasiswa_id, dosen_id, tahun, file_arsip) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'siiss', $judul, $mahasiswa_id, $dosen_id, $tahun, $file_arsip);
        return mysqli_stmt_execute($stmt);
    }

    // Update skripsi
    public function update($id, $judul, $mahasiswa_id, $dosen_id, $tahun, $file_arsip) {
        $sql = "UPDATE skripsi SET judul = ?, mahasiswa_id = ?, dosen_id = ?, tahun = ?, file_arsip = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'siissi', $judul, $mahasiswa_id, $dosen_id, $tahun, $file_arsip, $id);
        return mysqli_stmt_execute($stmt);
    }

    // Hapus skripsi
    public function delete($id) {
        $sql = "DELETE FROM skripsi WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }
}
