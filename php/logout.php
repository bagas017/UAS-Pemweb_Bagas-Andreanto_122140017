<?php
session_start();

// Hapus semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Hapus token dari cookie
setcookie('user_token', '', time() - 3600, '/');

// Redirect ke halaman index.html
header('Location: ../index.html');
exit;
?>
