<?php
session_start();
include 'config.php'; 

// Cek apakah user sudah login
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_token']) || !isset($_COOKIE['user_token'])) {
    echo "<script>
        alert('Akses ditolak. Halaman ini hanya untuk admin.');
        window.location.href = 'dashboard.php';
    </script>";
    exit;
}

// Validasi token dari cookie
if ($_SESSION['user_token'] !== $_COOKIE['user_token']) {
    session_destroy();
    echo "<script>
        alert('Akses ditolak. Halaman ini hanya untuk admin.');
        window.location.href = 'login.php';
    </script>";
    exit;
}

// Cek apakah user adalah admin
if ($_SESSION['username'] !== 'admin') {
    echo "<script>
        alert('Akses ditolak. Halaman ini hanya untuk admin.');
        window.location.href = 'dashboard.php';
    </script>";
    exit;
}

// Buat koneksi database menggunakan class Database
$db = (new Database())->connect();

// Ambil data user dari database
$query = "SELECT id, username, email, ip_address, browser FROM users";
$stmt = $db->prepare($query); 
if (!$stmt) {
    echo "Error: " . $db->error;
    exit;
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Users</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Data Users</h2>
    <a href="dashboard.php" class="button-back-read">Kembali ke Dashboard</a>
    <?php if ($result && $result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>IP Address</th>
                <th>Browser</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['ip_address']); ?></td>
                <td><?php echo htmlspecialchars($row['browser']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Tidak ada data user ditemukan.</p>
    <?php endif; ?>
</body>
</html>
