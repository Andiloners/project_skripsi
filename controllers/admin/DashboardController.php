<?php
class DashboardController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
        $this->auth->requireRole('admin');
    }

    public function index() {
        // Ambil data untuk dashboard
        $totalMahasiswa = $this->getTotalMahasiswa();
        $totalDosen = $this->getTotalDosen();
        $totalSkripsi = $this->getTotalSkripsi();
        $totalPengajuan = $this->getTotalPengajuan();
        
        $data = [
            'totalMahasiswa' => $totalMahasiswa,
            'totalDosen' => $totalDosen,
            'totalSkripsi' => $totalSkripsi,
            'totalPengajuan' => $totalPengajuan
        ];
        
        load_view('admin', 'dashboard', null, $data);
    }

    private function getTotalMahasiswa() {
        $sql = "SELECT COUNT(*) as total FROM mahasiswa";
        $result = $this->db->query($sql);
        $row = $this->db->fetch($result);
        return $row['total'];
    }

    private function getTotalDosen() {
        $sql = "SELECT COUNT(*) as total FROM dosen";
        $result = $this->db->query($sql);
        $row = $this->db->fetch($result);
        return $row['total'];
    }

    private function getTotalSkripsi() {
        $sql = "SELECT COUNT(*) as total FROM skripsi";
        $result = $this->db->query($sql);
        $row = $this->db->fetch($result);
        return $row['total'];
    }

    private function getTotalPengajuan() {
        $sql = "SELECT COUNT(*) as total FROM pengajuan_skripsi";
        $result = $this->db->query($sql);
        $row = $this->db->fetch($result);
        return $row['total'];
    }
} 