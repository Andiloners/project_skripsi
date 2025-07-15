<?php
require_once __DIR__ . '/../config/config.php';

class RuangPenyimpanan {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Ambil semua ruang penyimpanan
    public function getAll() {
        $sql = "SELECT * FROM ruang_penyimpanan";
        $result = mysqli_query($this->conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil ruang penyimpanan berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM ruang_penyimpanan WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Tambah ruang penyimpanan
    public function create($nama, $lokasi, $keterangan) {
        $sql = "INSERT INTO ruang_penyimpanan (nama, lokasi, keterangan) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $nama, $lokasi, $keterangan);
        return mysqli_stmt_execute($stmt);
    }

    // Update ruang penyimpanan
    public function update($id, $nama, $lokasi, $keterangan) {
        $sql = "UPDATE ruang_penyimpanan SET nama = ?, lokasi = ?, keterangan = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssi', $nama, $lokasi, $keterangan, $id);
        return mysqli_stmt_execute($stmt);
    }

    // Hapus ruang penyimpanan
    public function delete($id) {
        $sql = "DELETE FROM ruang_penyimpanan WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }
}
