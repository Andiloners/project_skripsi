<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/config/config.php';

// Fungsi untuk memuat view
function load_view($role, $page, $subpage = null, $data = []) {
    $base_path = __DIR__ . "/views/$role/";
    if ($subpage) {
        $file = $base_path . "$page/$subpage.php";
    } else {
        $file = $base_path . "$page.php";
    }
    if (file_exists($file)) {
        extract($data);
        include $file;
    } else {
        // Tampilkan pesan error jika file tidak ditemukan
        echo '<h2>404 - Halaman tidak ditemukan</h2>';
        echo '<p>File: ' . htmlspecialchars($file) . '</p>';
    }
}

// Routing ke controller
$role = isset($_GET['role']) ? $_GET['role'] : 'admin'; // default admin
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Login'; // default Login
$action = isset($_GET['action']) ? $_GET['action'] : 'index'; // default index
$id = isset($_GET['id']) ? $_GET['id'] : null;

$controllerFile = __DIR__ . "/controllers/$role/{$controller}Controller.php";
$controllerClass = $controller . 'Controller';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerClass)) {
        $ctrl = new $controllerClass();
        if (method_exists($ctrl, $action)) {
            if ($id !== null) {
                $ctrl->$action($id);
            } else {
                $ctrl->$action();
            }
        } else {
            echo "<h2>404 - Method '$action' tidak ditemukan di controller $controllerClass</h2>";
        }
    } else {
        echo "<h2>404 - Class controller $controllerClass tidak ditemukan</h2>";
    }
} else {
    echo "<h2>404 - File controller $controllerFile tidak ditemukan</h2>";
}
?>
