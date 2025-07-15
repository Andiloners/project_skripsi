<?php
class DashboardController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
        $this->auth->requireRole('kajur');
    }

    public function index() {
        // Ambil data untuk dashboard
        $totalMahasiswa = $this->getTotalMahasiswa();
        $totalDosen = $this->getTotalDosen();
        $totalSkripsi = $this->getTotalSkripsi();
        $totalPengajuan = $this->getTotalPengajuan();
        $pengajuanMenunggu = $this->getPengajuanMenunggu();
        
        $data = [
            'totalMahasiswa' => $totalMahasiswa,
            'totalDosen' => $totalDosen,
            'totalSkripsi' => $totalSkripsi,
            'totalPengajuan' => $totalPengajuan,
            'pengajuanMenunggu' => $pengajuanMenunggu
        ];
        
        load_view('kajur', 'dashboard', null, $data);
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

    private function getPengajuanMenunggu() {
        $sql = "SELECT COUNT(*) as total FROM pengajuan_skripsi WHERE status = 'Menunggu'";
        $result = $this->db->query($sql);
        $row = $this->db->fetch($result);
        return $row['total'];
    }
}
