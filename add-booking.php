<?php
session_start();
function logActivity($user_id, $action, $description) {
    // Koneksi ke database
    $conn = new mysqli("localhost", "username", "password", "kendaraan_monitoring");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Menyiapkan query untuk menyimpan log aktivitas
    $stmt = $conn->prepare("INSERT INTO log_activity (user_id, action, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $action, $description);

    // Menjalankan query
    if ($stmt->execute()) {
        echo "Activity logged successfully!";
    } else {
        echo "Error logging activity: " . $stmt->error;
    }

    // Menutup koneksi
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Move</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="assets/css/feathericon.min.css">
	<link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">
	<link rel="stylesheet" href="assets/css/style.css"> </head>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="main-wrapper">
        <!-- Header -->
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
							<h3 class="page-title mt-5">All Booking</h3> </div>
					</div>
				</div>


                <div class="row">
    <div class="col-lg-12">
        <form action="process_booking.php" method="POST">
            <div class="row formtype">
                <!-- Nama Pemesan -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_name">Nama Pemesan</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                    </div>
                </div>

                <!-- Tanggal Pemesanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="booking_date">Tanggal Pemesanan</label>
                        <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                    </div>
                </div>
            </div>
            
            <!-- Tombol untuk Melanjutkan ke Pemilihan Kendaraan -->
            <button type="submit" class="btn btn-primary buttonedit mt-5">Lanjutkan ke Pemilihan Kendaraan</button>
        </form>
        <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menambahkan log saat tombol ditekan
    $user_id = $_SESSION['user_id'];
    logActivity($user_id, 'Start Vehicle Booking', 'Started the vehicle booking process for ' . $_POST['customer_name']);
}
?>
    </div>
</div>

        
        

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active"><a href="index.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard-list"></i> <span>Pemesanan Kendaraan</span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class">
                        <li><a href="all_booking.php">Semua Pemesanan</a></li>
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <li><a href="add-booking.php">Tambah Pemesanan</a></li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Menu Log Aktivitas hanya terlihat untuk admin -->
                <?php if ($_SESSION['role'] == 'admin') { ?>
                <li class="submenu">
                    <a href="#"><i class="fas fa-history"></i> <span>Log Aktivitas</span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class">
                        <li><a href="activity-log.php">Aktivitas Terbaru</a></li>
                    </ul>
                </li>
                <?php } ?>

                <!-- Menu Export untuk Semua Pengguna -->
                <li class="submenu">
                    <a href="#"><i class="fas fa-file-export"></i> <span>Export</span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class">
                        <li><a href="export-activity-log.php">Export Log Aktivitas</a></li>
                    </ul>
                </li>

                <!-- Menu Baru untuk Driver -->
                <li class="submenu">
    <a href="#"><i class="fas fa-user"></i> <span>Driver</span> <span class="menu-arrow"></span></a>
    <ul class="submenu_class">
        <li><a href="all-driver.php">Semua Driver</a></li>
        <?php if ($_SESSION['role'] == 'admin') { ?>
            <li><a href="add-driver.php">Tambah Driver</a></li>
        <?php } ?>
    </ul>
</li>

                <!-- Menu Baru untuk Kendaraan -->
                <li class="submenu">
                    <a href="#"><i class="fas fa-car-alt"></i> <span>Kendaraan</span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class">
                        <li><a href="all-vehicles.php">Semua Kendaraan</a></li>
                        <li><a href="add-vehicle.php">Tambah Kendaraan</a></li>
                    </ul>
                </li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
            </ul>
        </div>
    </div>
</div>




        
    </div>
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/raphael/raphael.min.js"></script>
	<script src="assets/plugins/morris/morris.min.js"></script>
	<script src="assets/js/chart.morris.js"></script>
	<script src="assets/js/script.js"></script>


    <!-- Chart.js Script -->
   
</body>

</html>
