<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil Dosen</title>
</head>
<body>
    <h1>Edit Profil Dosen</h1>
    <?php
    require_once __DIR__ . '/../../../models/Dosen.php';
    $dosenModel = new Dosen($conn);
    $id = isset($_SESSION['user']['id']) ? intval($_SESSION['user']['id']) : 0;
    $dosen = $dosenModel->getById($id);
    if (!$dosen) {
        echo '<p>Profil tidak ditemukan.</p>';
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = $dosenModel->update($id, $_POST['nama'], $dosen['nip'], $_POST['email']);
        if ($result) {
            echo '<p>Berhasil mengupdate profil.</p>';
        } else {
            echo '<p>Gagal mengupdate profil.</p>';
        }
    }
    ?>
    <form method="post" action="">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($dosen['nama']); ?>" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($dosen['email']); ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
