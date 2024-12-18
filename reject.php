<?php
session_start();
require 'db.php';

// Pastikan user yang mengakses adalah pihak yang menyetujui (approver)
if ($_SESSION['role'] !== 'approver') {
    header('Location: login.php'); // Arahkan kembali ke halaman login jika bukan approver
    exit;
}

// Cek apakah ada ID pemesanan yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Update status pemesanan menjadi 'rejected'
    $query = $db->prepare("UPDATE bookings SET status = 'rejected' WHERE id = ?");
    $query->execute([$booking_id]);

    // Tambahkan log aktivitas
    $log_query = $db->prepare("INSERT INTO logs (user_id, activity) VALUES (?, ?)");
    $log_query->execute([$_SESSION['user_id'], "Menolak pemesanan kendaraan dengan ID: $booking_id"]);

    // Arahkan kembali ke dashboard approver setelah proses
    header('Location: approver_dashboard.php');
    exit;
} else {
    // Jika ID pemesanan tidak ditemukan, tampilkan pesan error
    echo "ID pemesanan tidak ditemukan!";
}
?>
