<?php
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db_name = 'db_skripsi';
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db_name);
        if (!$this->conn) {
            die('Koneksi database gagal: ' . mysqli_connect_error());
        }
    }

    public function query($sql) {
        try {
            $result = mysqli_query($this->conn, $sql);
            if ($result === false) {
                // Simpan pesan error jika perlu
                // $this->last_error = mysqli_error($this->conn);
                return false;
            }
            return $result;
        } catch (mysqli_sql_exception $e) {
            // Tangkap error MySQLi (misal foreign key constraint)
            // $this->last_error = $e->getMessage();
            return false;
        }
    }

    public function fetch($result) {
        return mysqli_fetch_assoc($result);
    }

    public function fetchAll($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function numRows($result) {
        return mysqli_num_rows($result);
    }

    public function affectedRows() {
        return mysqli_affected_rows($this->conn);
    }

    public function insertId() {
        return mysqli_insert_id($this->conn);
    }

    public function escape($string) {
        return mysqli_real_escape_string($this->conn, $string);
    }

    public function close() {
        mysqli_close($this->conn);
    }
}
?> 