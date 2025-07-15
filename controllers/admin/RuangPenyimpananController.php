<?php
class RuangPenyimpananController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
        $this->auth->requireRole('admin');
    }

    public function index() {
        $sql = "SELECT * FROM ruang_penyimpanan ORDER BY nama";
        $result = $this->db->query($sql);
        $ruang = $this->db->fetchAll($result);
        
        load_view('admin', 'ruang_penyimpanan', 'list', ['ruang' => $ruang]);
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $this->db->escape($_POST['nama']);
            $lokasi = $this->db->escape($_POST['lokasi']);
            $keterangan = $this->db->escape($_POST['keterangan']);
            
            $sql = "INSERT INTO ruang_penyimpanan (nama, lokasi, keterangan) VALUES ('$nama', '$lokasi', '$keterangan')";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=RuangPenyimpanan&action=index');
                exit();
            } else {
                $error = 'Gagal menambah ruang penyimpanan';
            }
        }
        
        load_view('admin', 'ruang_penyimpanan', 'tambah', ['error' => $error ?? '']);
    }

    public function edit($id) {
        $id = $this->db->escape($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $this->db->escape($_POST['nama']);
            $lokasi = $this->db->escape($_POST['lokasi']);
            $keterangan = $this->db->escape($_POST['keterangan']);
            
            $sql = "UPDATE ruang_penyimpanan SET nama='$nama', lokasi='$lokasi', keterangan='$keterangan' WHERE id=$id";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=RuangPenyimpanan&action=index');
                exit();
            } else {
                $error = 'Gagal mengupdate ruang penyimpanan';
            }
        }
        
        // Ambil data ruang
        $sql = "SELECT * FROM ruang_penyimpanan WHERE id=$id";
        $result = $this->db->query($sql);
        $ruang = $this->db->fetch($result);
        
        load_view('admin', 'ruang_penyimpanan', 'edit', ['ruang' => $ruang, 'error' => $error ?? '']);
    }

    public function hapus($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM ruang_penyimpanan WHERE id=$id";
        
        if ($this->db->query($sql)) {
            header('Location: index.php?role=admin&controller=RuangPenyimpanan&action=index');
            exit();
        } else {
            echo 'Gagal menghapus ruang penyimpanan';
        }
    }

    public function detail($id) {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM ruang_penyimpanan WHERE id = $id";
        $result = $this->db->query($sql);
        $ruang = $this->db->fetch($result);
        
        if (!$ruang) {
            header('Location: index.php?role=admin&controller=RuangPenyimpanan&action=index');
            exit();
        }
        
        load_view('admin', 'ruang_penyimpanan', 'detail', ['ruang' => $ruang]);
    }
}