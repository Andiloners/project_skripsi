<?php
class DosenController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
        $this->auth->requireRole('admin');
    }

    public function index() {
        $sql = "SELECT * FROM dosen ORDER BY nama";
        $result = $this->db->query($sql);
        $dosen = $this->db->fetchAll($result);
        
        load_view('admin', 'dosen', 'list', ['dosen' => $dosen]);
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $this->db->escape($_POST['nama']);
            $nip = $this->db->escape($_POST['nip']);
            $email = $this->db->escape($_POST['email']);
            
            $sql = "INSERT INTO dosen (nama, nip, email) VALUES ('$nama', '$nip', '$email')";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=Dosen&action=index');
                exit();
            } else {
                $error = 'Gagal menambah dosen';
            }
        }
        
        load_view('admin', 'dosen', 'tambah', ['error' => $error ?? '']);
    }

    public function edit($id) {
        $id = $this->db->escape($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $this->db->escape($_POST['nama']);
            $nip = $this->db->escape($_POST['nip']);
            $email = $this->db->escape($_POST['email']);
            
            $sql = "UPDATE dosen SET nama='$nama', nip='$nip', email='$email' WHERE id=$id";
            if ($this->db->query($sql)) {
                header('Location: index.php?role=admin&controller=Dosen&action=index');
                exit();
            } else {
                $error = 'Gagal mengupdate dosen';
            }
        }
        
        // Ambil data dosen
        $sql = "SELECT * FROM dosen WHERE id=$id";
        $result = $this->db->query($sql);
        $dosen = $this->db->fetch($result);
        
        load_view('admin', 'dosen', 'edit', ['dosen' => $dosen, 'error' => $error ?? '']);
    }

    public function hapus($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM dosen WHERE id=$id";
        
        if ($this->db->query($sql)) {
            header('Location: index.php?role=admin&controller=Dosen&action=index');
            exit();
        } else {
            // Jika gagal, redirect ke index dengan pesan error
            $error = urlencode('Tidak dapat menghapus dosen karena masih terhubung dengan data skripsi atau pengajuan. Hapus data terkait terlebih dahulu.');
            header('Location: index.php?role=admin&controller=Dosen&action=index&error=' . $error);
            exit();
        }
    }
}