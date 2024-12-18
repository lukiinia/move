<?php
session_start();
include('db.php');  // Pastikan koneksi ke database sudah benar

// Query untuk mengambil data pemesanan tanpa menggunakan user_id
$query = "SELECT b.id, b.customer_name, b.booking_date, v.name AS vehicle_name, v.foto AS vehicle_image, d.nama_driver, b.status, b.created_at,
          b.approver1_status, b.approver2_status
          FROM bookings b
          JOIN vehicles v ON b.vehicle_id = v.id
          JOIN driver d ON b.driver_id = d.id_driver";

$result = mysqli_query($conn, $query); // Use $query here instead of $sql

// Cek apakah data ditemukan
if (mysqli_num_rows($result) > 0) {
    $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $bookings = [];
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
        <h3 class="page-title mt-5">All Booking</h3>
    </div>
    <?php if ($_SESSION['role'] == 'admin'): ?>  <!-- Cek jika role user adalah admin -->
        <a href="add-booking.php" class="btn btn-primary float-right veiwbutton">Add Booking</a>
    <?php endif; ?>
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



<div class="row">
					<div class="col-sm-12">
						<div class="card card-table">
							<div class="card-body booking_card">
								<div class="table-responsive">
                                <table class="datatable table table-striped table-hover table-center mb-0">

                                        <thead>
                                            <tr>
                                                <th>Nama Pelanggan</th>
                                                <th>Nama Kendaraan</th>
                                                <th>Foto Kendaraan</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Nama Driver</th>
                                                <th>Status</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bookings as $booking): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($booking['customer_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($booking['vehicle_name']); ?></td>
                                                    <td>
                                                        <?php if (!empty($booking['vehicle_image'])): ?>
                                                            <img src="uploads/<?php echo htmlspecialchars($booking['vehicle_image']); ?>" alt="Image" width="100">
                                                        <?php else: ?>
                                                            <p>No Image</p>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                                                    <td><?php echo htmlspecialchars($booking['nama_driver']); ?></td>
                                                    <td><?php echo htmlspecialchars($booking['status']); ?></td>
                                                    <td><?php echo htmlspecialchars($booking['created_at']); ?></td>
                                                    <td>
    <?php if ($_SESSION['role'] == 'approver'): ?>
        <?php if ($booking['approver1_status'] == 'pending' && $_SESSION['approver_level'] == 'approver1'): ?>
            <!-- Tombol untuk approver pertama -->
            <a href="approve.php?id=<?php echo $booking['id']; ?>&approver=1&action=setuju" class="btn btn-success">Setuju</a>
            <a href="approve.php?id=<?php echo $booking['id']; ?>&approver=1&action=tidak" class="btn btn-danger">Tidak</a>
        <?php elseif ($booking['approver1_status'] == 'approved' && $booking['approver2_status'] == 'pending' && $_SESSION['approver_level'] == 'approver2'): ?>
            <!-- Tombol untuk approver kedua -->
            <a href="approve.php?id=<?php echo $booking['id']; ?>&approver=2&action=setuju" class="btn btn-success">Setuju</a>
            <a href="approve.php?id=<?php echo $booking['id']; ?>&approver=2&action=tidak" class="btn btn-danger">Tidak</a>
        <?php endif; ?>
    <?php endif; ?>
</td>





                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
								</div>
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
