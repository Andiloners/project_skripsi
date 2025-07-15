<?php
class MahasiswaController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
        $this->auth->requireRole('admin');
    }

    public function index() {
        $sql = "SELECT * FROM mahasiswa ORDER BY nama";
        $result = $this->db->query($sql);
        $mahasiswa = $this->db->fetchAll($result);
        
        load_view('admin', 'mahasiswa', 'list', ['mahasiswa' => $mahasiswa]);
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $this->db->escape($_POST['nama']);
            $nim = $this->db->escape($_POST['nim']);
            $email = $this->db->escape($_POST['email']);
            $prodi = $this->db->escape($_POST['prodi']);
            
            $sql = "INSERT INTO mahasiswa (nama, nim, email, prodi) VALUES ('$nama', '$nim', '$email', '$prodi')";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=Mahasiswa&action=index');
                exit();
            } else {
                $error = 'Gagal menambah mahasiswa';
            }
        }
        
        load_view('admin', 'mahasiswa', 'tambah', ['error' => $error ?? '']);
    }

    public function edit($id) {
        $id = $this->db->escape($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $this->db->escape($_POST['nama']);
            $nim = $this->db->escape($_POST['nim']);
            $email = $this->db->escape($_POST['email']);
            $prodi = $this->db->escape($_POST['prodi']);
            
            $sql = "UPDATE mahasiswa SET nama='$nama', nim='$nim', email='$email', prodi='$prodi' WHERE id=$id";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=Mahasiswa&action=index');
                exit();
            } else {
                $error = 'Gagal mengupdate mahasiswa';
            }
        }
        
        // Ambil data mahasiswa
        $sql = "SELECT * FROM mahasiswa WHERE id=$id";
        $result = $this->db->query($sql);
        $mahasiswa = $this->db->fetch($result);
        
        load_view('admin', 'mahasiswa', 'edit', ['mahasiswa' => $mahasiswa, 'error' => $error ?? '']);
    }

    public function hapus($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM mahasiswa WHERE id=$id";
        
        if ($this->db->query($sql)) {
            header('Location: index.php?role=admin&controller=Mahasiswa&action=index');
            exit();
        } else {
            // Jika gagal, redirect ke index dengan pesan error
            $error = urlencode('Tidak dapat menghapus mahasiswa karena masih terhubung dengan data skripsi. Hapus skripsi terkait terlebih dahulu.');
            header('Location: index.php?role=admin&controller=Mahasiswa&action=index&error=' . $error);
            exit();
        }
    }
}