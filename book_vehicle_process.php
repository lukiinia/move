<?php
include 'db.php';

$vehicle_id = $_POST['vehicle_id'];
$driver_name = $_POST['driver_name'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$sql = "INSERT INTO bookings (vehicle_id, driver_name, start_date, end_date) 
        VALUES ('$vehicle_id', '$driver_name', '$start_date', '$end_date')";
if ($conn->query($sql) === TRUE) {
    echo "Pemesanan berhasil dibuat.";
} else {
    echo "Error: " . $conn->error;
}
?>
