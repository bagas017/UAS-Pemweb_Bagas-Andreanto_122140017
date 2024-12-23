<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_token'])) {
    header('Location: login.php');
    exit;
}

// Validasi token
$current_token = $_SESSION['user_token'] ?? null;
if (!$current_token || $_SESSION['user_token'] !== $current_token) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Buat koneksi database menggunakan class Database
$db = (new Database())->connect();

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data berdasarkan ID
$query = "SELECT * FROM race_registration WHERE id = ?";
$stmt = $db->prepare($query); 
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    // Cek apakah user adalah admin atau pemilik data
    if ($_SESSION['username'] === 'admin' || $data['user_id'] == $_SESSION['user_id']) {
        // Hapus data
        $deleteQuery = "DELETE FROM race_registration WHERE id = ?";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->bind_param('i', $id);
        $deleteStmt->execute();

        if ($deleteStmt->affected_rows > 0) {
            echo "<script>alert('Data berhasil dihapus.'); window.location.href = 'dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data.'); window.location.href = 'dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('Hanya admin atau pemilik data yang dapat menghapus.'); window.location.href = 'dashboard.php';</script>";
    }
} else {
    echo "<script>alert('Data tidak ditemukan.'); window.location.href = 'dashboard.php';</script>";
}
?>
