<?php
session_start();
include('db.php');  // Include koneksi database

// Pastikan user sudah login dan session user_id tersedia
if (!isset($_SESSION['user_id'])) {
    die("User not logged in!");
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari session
$action = 'login'; // Aksi yang dilakukan
$description = 'User logged in successfully'; // Deskripsi aksi

// Query untuk menyimpan log aktivitas ke dalam database
$log_query = "INSERT INTO log_activity (user_id, action, description) VALUES ('$user_id', '$action', '$description')";
if ($conn->query($log_query) === TRUE) {
    echo "Log berhasil disimpan";
} else {
    echo "Error: " . $log_query . "<br>" . $conn->error; // Menampilkan error jika gagal menyimpan log
}

// Ambil data log dari database
$query = "SELECT * FROM log_activity ORDER BY created_at DESC";
$result = $conn->query($query);

// Cek apakah koneksi berhasil
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Activity</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/feathericon.min.css">
    <link rel="stylesheet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
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
                            <h3 class="page-title mt-5">Log Activity</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body booking_card">
                                <div class="table-responsive">
                                    <table class="datatable table table-striped table-hover table-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>Action</th>
                                                <th>Description</th>
                                                <th>Log Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?php echo $row['user_id']; ?></td>
                                                    <td><?php echo $row['action']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td><?php echo $row['created_at']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/js/chart.morris.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
