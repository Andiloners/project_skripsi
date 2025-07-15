<?php
class SkripsiController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
        $this->auth->requireRole('admin');
    }

    public function index() {
        $sql = "SELECT s.*, m.nama as mahasiswa_nama, d.nama as dosen_nama, r.nama as ruang_nama 
                FROM skripsi s 
                LEFT JOIN mahasiswa m ON s.mahasiswa_id = m.id 
                LEFT JOIN dosen d ON s.dosen_id = d.id 
                LEFT JOIN ruang_penyimpanan r ON s.ruang_penyimpanan_id = r.id 
                ORDER BY s.tahun DESC";
        $result = $this->db->query($sql);
        $skripsi = $this->db->fetchAll($result);
        
        load_view('admin', 'skripsi', 'list', ['skripsi' => $skripsi]);
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $this->db->escape($_POST['judul']);
            $mahasiswa_id = $this->db->escape($_POST['mahasiswa_id']);
            $dosen_id = $this->db->escape($_POST['dosen_id']);
            $tahun = $this->db->escape($_POST['tahun']);
            $ruang_penyimpanan_id = $this->db->escape($_POST['ruang_penyimpanan_id']);
            
            // Handle file upload
            $file_arsip = '';
            if (isset($_FILES['file_arsip']) && $_FILES['file_arsip']['error'] == 0) {
                $upload_dir = __DIR__ . '/../../uploads/';
                $file_arsip = time() . '_' . $_FILES['file_arsip']['name'];
                move_uploaded_file($_FILES['file_arsip']['tmp_name'], $upload_dir . $file_arsip);
            }
            
            $sql = "INSERT INTO skripsi (judul, mahasiswa_id, dosen_id, tahun, file_arsip, ruang_penyimpanan_id) 
                    VALUES ('$judul', '$mahasiswa_id', '$dosen_id', '$tahun', '$file_arsip', '$ruang_penyimpanan_id')";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=Skripsi&action=index');
                exit();
            } else {
                $error = 'Gagal menambah skripsi';
            }
        }
        
        // Ambil data untuk dropdown
        $mahasiswa = $this->db->fetchAll($this->db->query("SELECT * FROM mahasiswa ORDER BY nama"));
        $dosen = $this->db->fetchAll($this->db->query("SELECT * FROM dosen ORDER BY nama"));
        $ruang = $this->db->fetchAll($this->db->query("SELECT * FROM ruang_penyimpanan ORDER BY nama"));
        
        load_view('admin', 'skripsi', 'tambah', [
            'error' => $error ?? '', 
            'mahasiswa' => $mahasiswa, 
            'dosen' => $dosen, 
            'ruang' => $ruang
        ]);
    }

    public function edit($id) {
        $id = $this->db->escape($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $this->db->escape($_POST['judul']);
            $mahasiswa_id = $this->db->escape($_POST['mahasiswa_id']);
            $dosen_id = $this->db->escape($_POST['dosen_id']);
            $tahun = $this->db->escape($_POST['tahun']);
            $ruang_penyimpanan_id = $this->db->escape($_POST['ruang_penyimpanan_id']);
            
            $sql = "UPDATE skripsi SET judul='$judul', mahasiswa_id='$mahasiswa_id', dosen_id='$dosen_id', 
                    tahun='$tahun', ruang_penyimpanan_id='$ruang_penyimpanan_id' WHERE id=$id";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=Skripsi&action=index');
                exit();
            } else {
                $error = 'Gagal mengupdate skripsi';
            }
        }
        
        // Ambil data skripsi
        $sql = "SELECT * FROM skripsi WHERE id=$id";
        $result = $this->db->query($sql);
        $skripsi = $this->db->fetch($result);
        
        // Ambil data untuk dropdown
        $mahasiswa = $this->db->fetchAll($this->db->query("SELECT * FROM mahasiswa ORDER BY nama"));
        $dosen = $this->db->fetchAll($this->db->query("SELECT * FROM dosen ORDER BY nama"));
        $ruang = $this->db->fetchAll($this->db->query("SELECT * FROM ruang_penyimpanan ORDER BY nama"));
        
        load_view('admin', 'skripsi', 'edit', [
            'skripsi' => $skripsi, 
            'error' => $error ?? '', 
            'mahasiswa' => $mahasiswa, 
            'dosen' => $dosen, 
            'ruang' => $ruang
        ]);
    }

    public function hapus($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM skripsi WHERE id=$id";
        
        if ($this->db->query($sql)) {
            header('Location: index.php?role=admin&controller=Skripsi&action=index');
            exit();
        } else {
            echo 'Gagal menghapus skripsi';
        }
    }

    public function detail($id) {
        $id = $this->db->escape($id);
        $sql = "SELECT s.*, m.nama as mahasiswa_nama, m.nim, d.nama as dosen_nama, d.nip, r.nama as ruang_nama 
                FROM skripsi s 
                LEFT JOIN mahasiswa m ON s.mahasiswa_id = m.id 
                LEFT JOIN dosen d ON s.dosen_id = d.id 
                LEFT JOIN ruang_penyimpanan r ON s.ruang_penyimpanan_id = r.id 
                WHERE s.id = $id";
        $result = $this->db->query($sql);
        $skripsi = $this->db->fetch($result);
        
        if (!$skripsi) {
            header('Location: index.php?role=admin&controller=Skripsi&action=index');
            exit();
        }
        
        load_view('admin', 'skripsi', 'detail', ['skripsi' => $skripsi]);
    }

    public function upload_arsip($id) {
        $id = $this->db->escape($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['file_arsip']) && $_FILES['file_arsip']['error'] == 0) {
                $upload_dir = __DIR__ . '/../../uploads/';
                $file_arsip = time() . '_' . $_FILES['file_arsip']['name'];
                
                if (move_uploaded_file($_FILES['file_arsip']['tmp_name'], $upload_dir . $file_arsip)) {
                    $sql = "UPDATE skripsi SET file_arsip = '$file_arsip' WHERE id = $id";
                    if ($this->db->query($sql)) {
                        header('Location: index.php?role=admin&controller=Skripsi&action=index');
                        exit();
                    } else {
                        $error = 'Gagal mengupdate file arsip';
                    }
                } else {
                    $error = 'Gagal mengupload file';
                }
            } else {
                $error = 'Pilih file terlebih dahulu';
            }
        }
        
        // Ambil data skripsi
        $sql = "SELECT * FROM skripsi WHERE id = $id";
        $result = $this->db->query($sql);
        $skripsi = $this->db->fetch($result);
        
        load_view('admin', 'skripsi', 'upload_arsip', [
            'skripsi' => $skripsi, 
            'error' => $error ?? ''
        ]);
    }
}