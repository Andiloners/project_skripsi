<?php
require_once __DIR__ . '/../config/config.php';

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Ambil semua user
    public function getAll() {
        $sql = "SELECT * FROM user";
        $result = mysqli_query($this->conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Ambil user berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Ambil user berdasarkan username
    public function getByUsername($username) {
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Tambah user
    public function create($username, $password, $role) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (username, password, role) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $username, $hash, $role);
        return mysqli_stmt_execute($stmt);
    }

    // Update user
    public function update($id, $username, $role) {
        $sql = "UPDATE user SET username = ?, role = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssi', $username, $role, $id);
        return mysqli_stmt_execute($stmt);
    }

    // Update password user
    public function updatePassword($id, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $hash, $id);
        return mysqli_stmt_execute($stmt);
    }

    // Hapus user
    public function delete($id) {
        $sql = "DELETE FROM user WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }

    // Autentikasi login
    public function authenticate($username, $password) {
        $user = $this->getByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
