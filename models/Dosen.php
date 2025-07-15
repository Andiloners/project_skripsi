<?php
require_once __DIR__ . '/../config/config.php';

class Dosen {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Ambil semua dosen
    public function getAll() {
        $sql = "SELECT * FROM dosen";
        $result = mysqli_query($this->conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil dosen berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM dosen WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Tambah dosen
    public function create($nama, $nip, $email) {
        $sql = "INSERT INTO dosen (nama, nip, email) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $nama, $nip, $email);
        return mysqli_stmt_execute($stmt);
    }

    // Update dosen
    public function update($id, $nama, $nip, $email) {
        $sql = "UPDATE dosen SET nama = ?, nip = ?, email = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssi', $nama, $nip, $email, $id);
        return mysqli_stmt_execute($stmt);
    }

    // Hapus dosen
    public function delete($id) {
        $sql = "DELETE FROM dosen WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }
}
