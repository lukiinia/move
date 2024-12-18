<?php
session_start();
// Koneksi ke database
include 'db.php';

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_driver = $_POST['nama_driver'];
    $no_telepon = $_POST['no_telepon'];
    $status = $_POST['status'];

    // Query untuk menyimpan data driver
    $query = "INSERT INTO driver (nama_driver, no_telepon, status, tanggal_bergabung)
              VALUES ('$nama_driver', '$no_telepon', '$status', CURDATE())";

    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman daftar driver
        header("Location: all-driver.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
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
				<a href="index.html" class="logo"> <img src="assets/img/hotel_logo.png" width="50" height="70" alt="logo"> <span class="logoclass">HOTEL</span> </a>
				<a href="index.html" class="logo logo-small"> <img src="assets/img/hotel_logo.png" alt="Logo" width="30" height="30"> </a>
			</div>
			<a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
			<a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
			<ul class="nav user-menu">
				<li class="nav-item dropdown noti-dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <i class="fe fe-bell"></i> <span class="badge badge-pill">3</span> </a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header"> <span class="notification-title">Notifications</span> <a href="javascript:void(0)" class="clear-noti"> Clear All </a> </div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-02.jpg">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Carlson Tech</span> has approved <span class="noti-title">your estimate</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-11.jpg">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">International Software
													Inc</span> has sent you a invoice in the amount of <span class="noti-title">$218</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-17.jpg">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">John Hendry</span> sent a cancellation request <span class="noti-title">Apple iPhone
													XR</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-13.jpg">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Mercury Software
													Inc</span> added a new product <span class="noti-title">Apple
													MacBook Pro</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="#">View all Notifications</a> </div>
					</div>
				</li>
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"><img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31" alt="Soeng Souy"></span> </a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm"> <img src="assets/img/profiles/avatar-01.jpg" alt="User Image" class="avatar-img rounded-circle"> </div>
							<div class="user-text">
								<h6>Soeng Souy</h6>
								<p class="text-muted mb-0">Administrator</p>
							</div>
						</div> <a class="dropdown-item" href="profile.html">My Profile</a> <a class="dropdown-item" href="settings.html">Account Settings</a> <a class="dropdown-item" href="login.html">Logout</a> </div>
				</li>
			</ul>
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
		<div class="header">
            <div class="header-left">
                <a href="index.php" class="logo">
                    <img src="BARUUUUUUUU.svg" width="20" height="20" alt="logo">
                </a>
            </div>
            <a href="javascript:void(0);" id="toggle_btn"><i class="fe fe-text-align-left"></i></a>
            
        </div>
            <div class="row">
                <div class="col-lg-12">
                <form action="" method="POST">
                            <div class="form-group">
                                <label for="nama_driver">Nama Driver</label>
                                <input type="text" class="form-control" name="nama_driver" id="nama_driver" placeholder="Masukkan nama driver" required>
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">Nomor Telepon</label>
                                <input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="Masukkan nomor telepon" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Driver</button>
                            <a href="all-driver.php" class="btn btn-secondary">Batal</a>
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