<?php
session_start();
require 'db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil username dan password dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek user di database dengan prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);  // Bind parameter untuk username
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifikasi jika user ditemukan dan password cocok
    if ($user && password_verify($password, $user['password'])) {
        // Jika login berhasil, simpan data user di session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['username'];

        // Jika user adalah approver, simpan level approver di session
        if ($user['role'] === 'approver') {
            $_SESSION['approver_level'] = $user['approver_level'];  // Menambahkan level approver ke session
        }

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            header('Location: index.php');
            exit;
        } else {
            header('Location: index.php');
            exit;
        }
    } else {
        // Jika login gagal, simpan pesan error di session dan redirect ke halaman login
        $_SESSION['error'] = 'Username atau password salah!';
        header('Location: login.php');
        exit;
    }
}
?>
