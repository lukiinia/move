<?php
session_start();
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vehicle_id'])) {
    $_SESSION['selected_vehicle'] = [
        'id' => $_POST['vehicle_id'],
        'name' => $_POST['vehicle_name'],
        'type' => $_POST['vehicle_type'],
        'status' => $_POST['vehicle_status'],
        'photo' => $_POST['vehicle_photo']
    ];

    header('Location: select-driver.php');
    exit;
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
    
        <div class="header">
            <div class="header-left">
                <a href="index.php" class="logo">
                    <img src="assets/img/hotel_logo.png" width="50" height="70" alt="logo">
                    <span class="logoclass">Move</span>
                </a>
                <a href="index.php" class="logo logo-small">
                    <img src="assets/img/hotel_logo.png" alt="Logo" width="30" height="30">
                </a>
            </div>
            <a href="javascript:void(0);" id="toggle_btn"><i class="fe fe-text-align-left"></i></a>
            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31" alt="Admin"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="assets/img/profiles/avatar-01.jpg" alt="User Image" class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6><?php echo $_SESSION['username']; ?></h6>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title mt-5">Pilih Kendaraan</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php
                    // Query untuk mengambil data kendaraan
                    $query = "SELECT * FROM vehicles";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($vehicle = mysqli_fetch_assoc($result)) {
                            $foto_path = !empty($vehicle['foto']) ? 'uploads/' . htmlspecialchars($vehicle['foto']) : 'uploads/default.jpg';
                            echo '<div class="col-md-4 mb-4">';
                            echo '    <div class="card">';
                            echo '        <img src="' . $foto_path . '" class="card-img-top" alt="Foto Kendaraan" style="height: 200px; object-fit: cover;">';
                            echo '        <div class="card-body">';
                            echo '            <h5 class="card-title">' . htmlspecialchars($vehicle['name']) . '</h5>';
                            echo '            <p class="card-text">Status: ' . htmlspecialchars($vehicle['status']) . '</p>';
                            echo '            <button class="btn btn-primary" data-toggle="modal" data-target="#vehicleModal' . $vehicle['id'] . '">Lihat Detail</button>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';

                            // Modal untuk detail kendaraan
                            echo '<div class="modal fade" id="vehicleModal' . $vehicle['id'] . '" tabindex="-1" role="dialog">';
                            echo '    <div class="modal-dialog">';
                            echo '        <div class="modal-content">';
                            echo '            <div class="modal-header">';
                            echo '                <h5 class="modal-title">Detail Kendaraan</h5>';
                            echo '                <button type="button" class="close" data-dismiss="modal">&times;</button>';
                            echo '            </div>';
                            echo '            <div class="modal-body">';
                            echo '                <p><strong>Nama Kendaraan:</strong> ' . htmlspecialchars($vehicle['name']) . '</p>';
                            echo '                <p><strong>No. Plat:</strong> ' . htmlspecialchars($vehicle['license_plate']) . '</p>';
                            echo '                <p><strong>Tipe:</strong> ' . htmlspecialchars($vehicle['type']) . '</p>';
                            echo '                <p><strong>Status:</strong> ' . htmlspecialchars($vehicle['status']) . '</p>';
                            echo '            </div>';
                            echo '            <div class="modal-footer">';
                            echo '                <form action="" method="POST">';
                            echo '                    <input type="hidden" name="vehicle_id" value="' . $vehicle['id'] . '">';
                            echo '                    <input type="hidden" name="vehicle_name" value="' . htmlspecialchars($vehicle['name']) . '">';
                            echo '                    <input type="hidden" name="vehicle_type" value="' . htmlspecialchars($vehicle['type']) . '">';
                            echo '                    <input type="hidden" name="vehicle_status" value="' . htmlspecialchars($vehicle['status']) . '">';
                            echo '                    <input type="hidden" name="vehicle_photo" value="' . htmlspecialchars($vehicle['foto']) . '">';
                            echo '                    <button type="submit" class="btn btn-success">Pilih Kendaraan</button>';
                            echo '                </form>';
                            echo '            </div>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="col-12"><p>Tidak ada data kendaraan tersedia.</p></div>';
                    }
                    ?>
                </div>
                <div class="sidebar" id="sidebar">
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
