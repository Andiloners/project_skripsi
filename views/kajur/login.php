<?php
if (!isset($conn)) {
    require_once __DIR__ . '/../../config/config.php';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Kajur</title>
</head>
<body>
    <h1>Login Kajur</h1>
    <form method="post" action="?role=kajur&page=login">
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <?php
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/../../models/User.php';
        $userModel = new User($conn);
        $user = $userModel->authenticate($_POST['username'], $_POST['password']);
        if ($user && $user['role'] === 'kajur') {
            $_SESSION['user'] = $user;
            header('Location: ?role=kajur&page=dashboard');
            exit;
        } else {
            echo '<p>Login gagal. Username atau password salah.</p>';
        }
    }
    ?>
</body>
</html>
