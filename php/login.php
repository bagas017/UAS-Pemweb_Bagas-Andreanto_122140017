<?php
session_start();
include 'config.php'; 

class User {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function authenticate($email, $password) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buat koneksi database
    $db = (new Database())->connect();
    $user = new User($db);

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Panggil metode authenticate
    $result = $user->authenticate($email, $password);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        if (password_verify($password, $userData['password'])) {
            // Set sesi dan cookie
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['username'] = $userData['username'];

            $token = bin2hex(random_bytes(32));
            $_SESSION['user_token'] = $token;
            setcookie('user_token', $token, time() + 3600, '/');

            // Gunakan JavaScript untuk menyimpan ke sessionStorage dan redirect
            echo "<script>
                sessionStorage.setItem('isLoggedIn', 'true');
                sessionStorage.setItem('username', '" . $userData['username'] . "');
                window.location.href = 'dashboard.php';
            </script>";
            exit;
        } else {
            // Password salah
            header('Location: ../index.html?error=invalid_password');
            exit;
        }
    } else {
        // Email tidak ditemukan
        header('Location: ../index.html?error=invalid_email');
        exit;
    }
}
?>
