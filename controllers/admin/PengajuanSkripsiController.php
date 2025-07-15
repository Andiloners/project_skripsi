<?php
class PengajuanSkripsiController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
        $this->auth->requireRole('admin');
    }

    public function index() {
        $sql = "SELECT * FROM pengajuan_skripsi ORDER BY tanggal DESC";
        $result = $this->db->query($sql);
        $pengajuan = $this->db->fetchAll($result);
        
        load_view('admin', 'pengajuan_skripsi', 'list', ['pengajuan' => $pengajuan]);
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mahasiswa_nama = $this->db->escape($_POST['mahasiswa_nama']);
            $judul = $this->db->escape($_POST['judul']);
            $tanggal = $this->db->escape($_POST['tanggal']);
            $status = $this->db->escape($_POST['status']);
            
            $sql = "INSERT INTO pengajuan_skripsi (mahasiswa_nama, judul, tanggal, status) VALUES ('$mahasiswa_nama', '$judul', '$tanggal', '$status')";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=PengajuanSkripsi&action=index');
                exit();
            } else {
                $error = 'Gagal menambah pengajuan skripsi';
            }
        }
        
        load_view('admin', 'pengajuan_skripsi', 'tambah', ['error' => $error ?? '']);
    }

    public function edit($id) {
        $id = $this->db->escape($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mahasiswa_nama = $this->db->escape($_POST['mahasiswa_nama']);
            $judul = $this->db->escape($_POST['judul']);
            $tanggal = $this->db->escape($_POST['tanggal']);
            $status = $this->db->escape($_POST['status']);
            
            $sql = "UPDATE pengajuan_skripsi SET mahasiswa_nama='$mahasiswa_nama', judul='$judul', tanggal='$tanggal', status='$status' WHERE id=$id";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=PengajuanSkripsi&action=index');
                exit();
            } else {
                $error = 'Gagal mengupdate pengajuan skripsi';
            }
        }
        
        // Ambil data pengajuan
        $sql = "SELECT * FROM pengajuan_skripsi WHERE id=$id";
        $result = $this->db->query($sql);
        $pengajuan = $this->db->fetch($result);
        
        load_view('admin', 'pengajuan_skripsi', 'edit', ['pengajuan' => $pengajuan, 'error' => $error ?? '']);
    }

    public function hapus($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM pengajuan_skripsi WHERE id=$id";
        
        if ($this->db->query($sql)) {
            header('Location: index.php?role=admin&controller=PengajuanSkripsi&action=index');
            exit();
        } else {
            echo 'Gagal menghapus pengajuan skripsi';
        }
    }

    public function detail($id) {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM pengajuan_skripsi WHERE id = $id";
        $result = $this->db->query($sql);
        $pengajuan = $this->db->fetch($result);
        
        if (!$pengajuan) {
            header('Location: index.php?role=admin&controller=PengajuanSkripsi&action=index');
            exit();
        }
        
        load_view('admin', 'pengajuan_skripsi', 'detail', ['pengajuan' => $pengajuan]);
    }
}