<?php
class BerandaController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
        $this->auth->requireRole('dosen');
    }

    public function index() {
        $user = $this->auth->getCurrentUser();
        
        // Ambil data dosen berdasarkan username
        $username = $this->db->escape($user['username']);
        $sql = "SELECT d.* FROM dosen d 
                INNER JOIN user u ON d.email = u.username 
                WHERE u.username = '$username'";
        $result = $this->db->query($sql);
        $dosen = $this->db->fetch($result);
        
        // Hitung statistik
        $totalSkripsi = $this->getTotalSkripsi($dosen['id']);
        $totalJadwal = $this->getTotalJadwal();
        
        $data = [
            'dosen' => $dosen,
            'totalSkripsi' => $totalSkripsi,
            'totalJadwal' => $totalJadwal
        ];
        
        load_view('dosen', 'beranda', null, $data);
    }

    private function getTotalSkripsi($dosen_id) {
        $dosen_id = $this->db->escape($dosen_id);
        $sql = "SELECT COUNT(*) as total FROM skripsi WHERE dosen_id = $dosen_id";
        $result = $this->db->query($sql);
        $row = $this->db->fetch($result);
        return $row['total'];
    }

    private function getTotalJadwal() {
        $sql = "SELECT COUNT(*) as total FROM jadwal_ups WHERE tanggal >= CURDATE()";
        $result = $this->db->query($sql);
        $row = $this->db->fetch($result);
        return $row['total'];
    }
}