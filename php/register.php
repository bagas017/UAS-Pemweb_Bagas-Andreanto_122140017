<?php
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buat koneksi database
    $db = (new Database())->connect();

    // Periksa apakah koneksi berhasil
    if (!$db) {
        die("Koneksi database gagal.");
    }

    // Ambil data dari form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Dapatkan IP Address dan Browser
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $browser = $_SERVER['HTTP_USER_AGENT'];

    // Query untuk menyimpan data
    $query = "INSERT INTO users (username, email, password, ip_address, browser) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    if ($stmt) {
        $stmt->bind_param('sssss', $username, $email, $hashed_password, $ip_address, $browser);
        if ($stmt->execute()) {
            // Redirect ke halaman login setelah berhasil register
            header('Location: ../index.html');
            exit;
        } else {
            echo "Gagal menyimpan data: " . $stmt->error;
        }
    } else {
        echo "Kesalahan dalam persiapan query: " . $db->error;
    }
}
?>
