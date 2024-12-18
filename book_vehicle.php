<form method="POST" action="book_vehicle_process.php">
    <label for="vehicle_id">Kendaraan:</label>
    <select name="vehicle_id" id="vehicle_id">
        <?php
        include 'db.php';
        $sql = "SELECT id, name FROM vehicles WHERE status = 'tersedia'";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select>

    <label for="driver_name">Nama Driver:</label>
    <input type="text" name="driver_name" id="driver_name" required>

    <label for="start_date">Tanggal Mulai:</label>
    <input type="datetime-local" name="start_date" id="start_date" required>

    <label for="end_date">Tanggal Selesai:</label>
    <input type="datetime-local" name="end_date" id="end_date" required>

    <button type="submit">Pesan</button>
</form>
