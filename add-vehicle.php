<?php
// Koneksi ke database
include 'db.php';
session_start();

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $license_plate = $_POST['license_plate'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    // Handle upload foto
    $foto_name = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto_name);

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        // Query untuk menyimpan data kendaraan
        $query = "INSERT INTO vehicles (name, license_plate, type, status, foto, created_at)
                  VALUES ('$name', '$license_plate', '$type', '$status', '$foto_name', NOW())";

        if (mysqli_query($conn, $query)) {
            // Redirect ke halaman daftar kendaraan
            header("Location: all-vehicles.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal mengupload foto.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Hotel Dashboard Template</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="assets/css/feathericon.min.css">
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="assets/css/style.css"> </head>

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

<div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Add Booking</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nama Kendaraan</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama kendaraan" required>
                        </div>
                        <div class="form-group">
                            <label for="license_plate">Nomor Plat</label>
                            <input type="text" class="form-control" name="license_plate" id="license_plate" placeholder="Masukkan nomor plat" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipe Kendaraan</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value="angkut_barang">Angkut Barang</option>
                                <option value="angkut_orang">Angkut Orang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status Kendaraan</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="tersedia">Tersedia</option>
                                <option value="digunakan">Digunakan</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Kendaraan</label>
                            <input type="file" class="form-control-file" name="foto" id="foto" required>
                        </div>
                        <button type="submit" class="btn btn-primary buttonedit1">Tambah Kendaraan</button>
                        <a href="all-vehicles.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
	</div>
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/raphael/raphael.min.js"></script>
	<script src="assets/js/script.js"></script>
	<script>
	$(function() {
		$('#datetimepicker3').datetimepicker({
			format: 'LT'
		});
	});
	</script>
</body>

</html>