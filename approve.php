<?php
session_start();
include('db.php');

// Cek apakah pengguna memiliki role yang sesuai
if ($_SESSION['role'] != 'approver') {
    header('Location: index.php'); // Redirect jika bukan approver
    exit;
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
$approver = isset($_GET['approver']) ? $_GET['approver'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;

if ($id && $approver && $action) {
    // Tentukan field status berdasarkan approver
    $statusField = ($approver == 1) ? 'approver1_status' : 'approver2_status';
    $oppositeApproverField = ($approver == 1) ? 'approver2_status' : 'approver1_status';

    // Tentukan status yang ingin diubah
    $status = ($action == 'setuju') ? 'approved' : 'rejected';

    // Gunakan prepared statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("UPDATE bookings SET $statusField = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    // Periksa apakah eksekusi query berhasil
    if ($stmt->affected_rows > 0) {
        // Periksa apakah kedua approver sudah menyetujui
        $stmtCheck = $conn->prepare("SELECT approver1_status, approver2_status FROM bookings WHERE id = ?");
        $stmtCheck->bind_param("i", $id);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();
        $booking = $resultCheck->fetch_assoc();

        // Jika kedua approver sudah menyetujui, ubah status booking menjadi 'approved'
        if ($booking['approver1_status'] == 'approved' && $booking['approver2_status'] == 'approved') {
            // Update status booking menjadi approved setelah kedua approver setuju
            $stmtUpdateStatus = $conn->prepare("UPDATE bookings SET status = 'approved' WHERE id = ?");
            $stmtUpdateStatus->bind_param("i", $id);
            $stmtUpdateStatus->execute();
        }
    }

    // Redirect ke halaman all_booking.php setelah update status
    header('Location: all_booking.php');
    exit;
} else {
    // Jika parameter id, approver, atau action tidak ada, redirect ke halaman all_booking.php
    header('Location: all_booking.php');
    exit;
}
?>
