<?php
include 'db.php';

$name = $_POST['name'];
$type = $_POST['type'];

$sql = "INSERT INTO vehicles (name, type) VALUES ('$name', '$type')";
if ($conn->query($sql) === TRUE) {
    echo "Kendaraan berhasil ditambahkan.";
} else {
    echo "Error: " . $conn->error;
}
?>
