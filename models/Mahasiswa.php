<?php
require_once __DIR__ . '/../config/config.php';

class Mahasiswa {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Ambil semua mahasiswa
    public function getAll() {
        $sql = "SELECT * FROM mahasiswa";
        $result = mysqli_query($this->conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil mahasiswa berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM mahasiswa WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Tambah mahasiswa
    public function create($nama, $nim, $email, $prodi) {
        $sql = "INSERT INTO mahasiswa (nama, nim, email, prodi) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $nama, $nim, $email, $prodi);
        return mysqli_stmt_execute($stmt);
    }

    // Update mahasiswa
    public function update($id, $nama, $nim, $email, $prodi) {
        $sql = "UPDATE mahasiswa SET nama = ?, nim = ?, email = ?, prodi = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $nim, $email, $prodi, $id);
        return mysqli_stmt_execute($stmt);
    }

    // Hapus mahasiswa
    public function delete($id) {
        $sql = "DELETE FROM mahasiswa WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }
}
