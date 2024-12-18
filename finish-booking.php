<?php
session_start();

// Pastikan kendaraan dan driver telah dipilih
if (!isset($_SESSION['selected_vehicle']) || !isset($_SESSION['selected_driver'])) {
    // Redirect atau tampilkan pesan jika kendaraan atau driver belum dipilih
    header('Location: all-vehicles.php');
    exit;
}

// Ambil data dari session
$vehicle = $_SESSION['selected_vehicle'];
$driver = $_SESSION['selected_driver'];
$customer_name = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : ''; // Nama pemesan dari session
$booking_date = isset($_SESSION['booking_date']) ? $_SESSION['booking_date'] : ''; // Tanggal pemesanan dari session

// Proses pemesanan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php'; // Koneksi database

    // Ambil data kendaraan dan driver dari session
    $vehicle_id = $vehicle['id'];
    $vehicle_name = $vehicle['name'];
    $driver_id = $driver['id'];
    $driver_name = $driver['name'];
    $driver_phone = $driver['phone'];

    // Ambil tanggal mulai dan selesai (bisa menggunakan input form atau set default)
    $start_date = date('Y-m-d H:i:s', strtotime('+1 day')); // Contoh: tanggal mulai besok
    $end_date = date('Y-m-d H:i:s', strtotime('+2 days')); // Contoh: tanggal selesai 2 hari setelah mulai

    // Query untuk menyimpan pemesanan (tanpa user_id)
    $query = "INSERT INTO bookings (vehicle_id, customer_name, start_date, end_date, driver_id, status, booking_date)
              VALUES ('$vehicle_id', '$customer_name', '$start_date', '$end_date', '$driver_id', 'pending', '$booking_date')";

    if (mysqli_query($conn, $query)) {
        // Hapus data kendaraan dan driver dari session setelah pemesanan selesai
        unset($_SESSION['selected_vehicle']);
        unset($_SESSION['selected_driver']);
        unset($_SESSION['customer_name']);
        unset($_SESSION['booking_date']);
        
        // Redirect ke halaman all-booking.php setelah pemesanan berhasil
        header('Location: all-booking.php');
        exit;
    } else {
        echo '<script>alert("Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pemesanan</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/feathericon.min.css">
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="main-wrapper">
    <div class="header">
            <div class="header-left">
                <a href="index.php" class="logo">
                    <img src="BARUUUUUUUU.svg" width="20" height="20" alt="logo">
                </a>
            </div>
            <a href="javascript:void(0);" id="toggle_btn"><i class="fe fe-text-align-left"></i></a>
            
        </div>
        
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title mt-5">Selesaikan Pemesanan</h3>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <img class="card-img-top" src="uploads/<?php echo htmlspecialchars($vehicle['photo']); ?>" style="height: 200px; object-fit: cover;" alt="Foto Kendaraan">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($vehicle['name']); ?></h5>
                        <p class="card-text">Tipe: <?php echo htmlspecialchars($vehicle['type']); ?></p>
                        <p class="card-text">Status: <?php echo htmlspecialchars($vehicle['status']); ?></p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Driver yang Dipilih</h5>
                        <p><strong>Nama Driver:</strong> <?php echo htmlspecialchars($driver['name']); ?></p>
                        <p><strong>No. Telepon:</strong> <?php echo htmlspecialchars($driver['phone']); ?></p>
                    </div>
                </div>

                <form action="finish-booking.php" method="POST">
                    <div class="row formtype">
                        <!-- Nama Pemesan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_name">Nama Pemesan</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>" required>
                            </div>
                        </div>

                        <!-- Tanggal Pemesanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="booking_date">Tanggal Pemesanan</label>
                                <input type="date" class="form-control" id="booking_date" name="booking_date" value="<?php echo htmlspecialchars($booking_date); ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success">Konfirmasi Pemesanan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
