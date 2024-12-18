<?php
include 'db.php';

$sql = "SELECT * FROM vehicles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['name'] . " - " . $row['type'] . " - " . $row['status'] . "<br>";
    }
} else {
    echo "Tidak ada kendaraan.";
}
?>
