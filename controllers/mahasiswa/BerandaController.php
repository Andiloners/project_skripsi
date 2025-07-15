<?php
class BerandaController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
        $this->auth->requireRole('mahasiswa');
    }

    public function index() {
        $user = $this->auth->getCurrentUser();
        
        // Ambil data mahasiswa berdasarkan username
        $username = $this->db->escape($user['username']);
        $sql = "SELECT m.* FROM mahasiswa m 
                INNER JOIN user u ON m.email = u.username 
                WHERE u.username = '$username'";
        $result = $this->db->query($sql);
        $mahasiswa = $this->db->fetch($result);
        
        // Hitung statistik
        $totalPengajuan = $this->getTotalPengajuan($mahasiswa['nama']);
        $totalJadwal = $this->getTotalJadwal();
        
        $data = [
            'mahasiswa' => $mahasiswa,
            'totalPengajuan' => $totalPengajuan,
            'totalJadwal' => $totalJadwal
        ];
        
        load_view('mahasiswa', 'beranda', null, $data);
    }

    private function getTotalPengajuan($nama) {
        $nama = $this->db->escape($nama);
        $sql = "SELECT COUNT(*) as total FROM pengajuan_skripsi WHERE mahasiswa_nama = '$nama'";
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