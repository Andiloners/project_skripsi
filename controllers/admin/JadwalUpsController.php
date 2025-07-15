<?php
class JadwalUpsController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
        $this->auth->requireRole('admin');
    }

    public function index() {
        $sql = "SELECT * FROM jadwal_ups ORDER BY tanggal, waktu";
        $result = $this->db->query($sql);
        $jadwal = $this->db->fetchAll($result);
        
        load_view('admin', 'jadwal_ups', 'list', ['jadwal' => $jadwal]);
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tanggal = $this->db->escape($_POST['tanggal']);
            $waktu = $this->db->escape($_POST['waktu']);
            $ruangan = $this->db->escape($_POST['ruangan']);
            $keterangan = $this->db->escape($_POST['keterangan']);
            
            $sql = "INSERT INTO jadwal_ups (tanggal, waktu, ruangan, keterangan) VALUES ('$tanggal', '$waktu', '$ruangan', '$keterangan')";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=JadwalUps&action=index');
                exit();
            } else {
                $error = 'Gagal menambah jadwal UPS';
            }
        }
        
        load_view('admin', 'jadwal_ups', 'tambah', ['error' => $error ?? '']);
    }

    public function edit($id) {
        $id = $this->db->escape($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tanggal = $this->db->escape($_POST['tanggal']);
            $waktu = $this->db->escape($_POST['waktu']);
            $ruangan = $this->db->escape($_POST['ruangan']);
            $keterangan = $this->db->escape($_POST['keterangan']);
            
            $sql = "UPDATE jadwal_ups SET tanggal='$tanggal', waktu='$waktu', ruangan='$ruangan', keterangan='$keterangan' WHERE id=$id";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=JadwalUps&action=index');
                exit();
            } else {
                $error = 'Gagal mengupdate jadwal UPS';
            }
        }
        
        // Ambil data jadwal
        $sql = "SELECT * FROM jadwal_ups WHERE id=$id";
        $result = $this->db->query($sql);
        $jadwal = $this->db->fetch($result);
        
        load_view('admin', 'jadwal_ups', 'edit', ['jadwal' => $jadwal, 'error' => $error ?? '']);
    }

    public function hapus($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM jadwal_ups WHERE id=$id";
        
        if ($this->db->query($sql)) {
            header('Location: index.php?role=admin&controller=JadwalUps&action=index');
            exit();
        } else {
            echo 'Gagal menghapus jadwal UPS';
        }
    }

    public function detail($id) {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM jadwal_ups WHERE id = $id";
        $result = $this->db->query($sql);
        $jadwal = $this->db->fetch($result);
        
        if (!$jadwal) {
            header('Location: index.php?role=admin&controller=JadwalUps&action=index');
            exit();
        }
        
        load_view('admin', 'jadwal_ups', 'detail', ['jadwal' => $jadwal]);
    }
}