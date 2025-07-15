<!DOCTYPE html>
<html>
<head>
    <title>Ganti Password Dosen</title>
</head>
<body>
    <h1>Ganti Password Dosen</h1>
    <?php
    require_once __DIR__ . '/../../../models/User.php';
    $userModel = new User($conn);
    $id = isset($_SESSION['user']['id']) ? intval($_SESSION['user']['id']) : 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        if ($password !== $password2) {
            echo '<p>Password baru dan konfirmasi tidak sama.</p>';
        } else {
            $result = $userModel->updatePassword($id, $password);
            if ($result) {
                echo '<p>Berhasil mengganti password.</p>';
            } else {
                echo '<p>Gagal mengganti password.</p>';
            }
        }
    }
    ?>
    <form method="post" action="">
        <label>Password Baru:</label><br>
        <input type="password" name="password" required><br>
        <label>Konfirmasi Password Baru:</label><br>
        <input type="password" name="password2" required><br><br>
        <button type="submit">Ganti Password</button>
    </form>
</body>
</html>
