<?php
class LoginController {
    private $auth;
    private $db;

    public function __construct() {
        global $auth, $db;
        $this->auth = $auth;
        $this->db = $db;
    }

    public function index() {
        // Jika sudah login, redirect ke dashboard
        if ($this->auth->isLoggedIn()) {
            header('Location: index.php?role=admin&controller=Dashboard&action=index');
            exit();
        }
        
        // Tampilkan form login
        load_view('admin', 'login');
    }

    public function prosesLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($this->auth->login($username, $password)) {
                $user = $this->auth->getCurrentUser();
                if ($user['role'] === 'admin') {
                    header('Location: index.php?role=admin&controller=Dashboard&action=index');
                    exit();
                } else {
                    $this->auth->logout();
                    $error = 'Anda tidak memiliki akses sebagai admin';
                }
            } else {
                $error = 'Username atau password salah';
            }
        }
        
        // Tampilkan form login dengan error
        load_view('admin', 'login', null, ['error' => $error ?? '']);
    }

    public function logout() {
        $this->auth->logout();
    }
} 