<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_token']) || !isset($_COOKIE['user_token'])) {
    header('Location: login.php');
    exit;
}

// Melakukan Validasi token dari cookie
if ($_SESSION['user_token'] !== $_COOKIE['user_token']) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// membuat koneksi ke database
$db = (new Database())->connect();

// Ambil data pendaftaran berdasarkan user_id
$query = "SELECT * FROM race_registration";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$is_admin = $_SESSION['username'] === 'admin';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="welcome-message">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    </div>
    <div class="action-buttons">
        <div class="button-group">
            <a href="register_race.php" class="button-daftar">Daftar Race Baru</a>
            <a href="users.php" class="button-data">Data Users</a>
        </div>
        <a href="logout.php" class="button-logout">Logout</a>
    </div>
    <table border="1">
        <tr>
            <th>ID Pembalap</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Sirkuit</th>
            <th>Operation</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['class']; ?></td>
            <td><?php echo $row['circuit']; ?></td>
            <td>
                <a href="read.php?id=<?php echo $row['id']; ?>" class="button-read">Open</a>
                <?php if ($is_admin || $row['user_id'] == $_SESSION['user_id']): ?>
                    <a href="update.php?id=<?php echo $row['id']; ?>" class="button-update">Update</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="button-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                <?php else: ?>
                    <a href="#" class="button-update" onclick="alert('Anda tidak memiliki akses ke fitur ini.'); return false;">Update</a>
                    <a href="#" class="button-delete" onclick="alert('Anda tidak memiliki akses ke fitur ini.'); return false;">Delete</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    
    <script>
        // Ambil data dari sessionStorage
        const username = sessionStorage.getItem('username');
    
        // Tampilkan pesan selamat datang jika username ada di sessionStorage
        if (username) {
            document.querySelector('h2').textContent = `Welcome, ${username}!`;
        } else {
            alert("Anda tidak login.");
            window.location.href = 'login.php';
        }
    </script>

</body>


</html>
