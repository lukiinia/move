<?php
session_start();

// Pastikan form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simpan data booking
    $_SESSION['customer_name'] = $_POST['customer_name'];
    $_SESSION['booking_date'] = $_POST['booking_date'];

    // Redirect ke halaman pemilihan kendaraan
    header('Location: vehicle-selection.php');
    exit();
}
?>
