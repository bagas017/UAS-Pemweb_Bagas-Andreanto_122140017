<?php
session_start();
include 'config.php';
include 'race_manager.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$db = (new Database())->connect();
$raceManager = new RaceManager($db);

// Gunakan metode getRaceDetails
$data = $raceManager->getRaceDetails($id);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Data</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Detail Data Pendaftaran</h2>
    <p>Nama: <?php echo htmlspecialchars($data['name']); ?></p>
    <p>Umur: <?php echo htmlspecialchars($data['age']); ?></p>
    <p>Negara: <?php echo htmlspecialchars($data['country']); ?></p>
    <p>Kelas: <?php echo htmlspecialchars($data['class']); ?></p>
    <p>Jenis Mobil: <?php echo htmlspecialchars($data['car_type']); ?></p>
    <p>Sirkuit: <?php echo htmlspecialchars($data['circuit']); ?></p>
    <p>Tanggal Race: <?php echo htmlspecialchars($data['race_date']); ?></p>
    <a href="dashboard.php" class="button-back-read">Kembali</a>
</body>
</html>
