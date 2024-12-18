<?php
session_start();
// Koneksi database
include 'db.php';


// Ambil data kendaraan dari database
$query = "SELECT id, name AS vehicle_name, foto, type, status FROM vehicles ORDER BY id DESC";
$result = mysqli_query($conn, $query);
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
                        <div class="mt-5">
    <h4 class="card-title float-left mt-2">All Vehicles</h4>
    <?php if ($_SESSION['role'] == 'admin') { ?>
        <a href="add-vehicle.php" class="btn btn-primary float-right">Add Vehicle</a>
    <?php } ?>
</div>

                        </div>
                    </div>
                </div>

                <!-- Vehicle Table -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Kendaraan</th>
                                                <th>Foto</th>
                                                <th>Tipe</th>
                                                <th>Status</th>
                                                <th class="text-right">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['vehicle_name']); ?></td>
                                                    <td>
                                                        <?php if (!empty($row['foto'])): ?>
                                                            <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" width="50" height="50" alt="Foto Kendaraan">
                                                        <?php else: ?>
                                                            <span>Tidak ada foto</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars(ucfirst($row['type'])); ?></td>
                                                    <td>
                                                        <?php
                                                            switch ($row['status']) {
                                                                case 'tersedia':
                                                                    echo '<span class="badge badge-success">Tersedia</span>';
                                                                    break;
                                                                case 'digunakan':
                                                                    echo '<span class="badge badge-warning">Digunakan</span>';
                                                                    break;
                                                                case 'maintenance':
                                                                    echo '<span class="badge badge-danger">Maintenance</span>';
                                                                    break;
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="text-right">
    <?php if ($_SESSION['role'] == 'admin') { ?>
        <a href="edit-vehicle.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-pencil-alt"></i> Edit
        </a>
        <a href="delete-vehicle.php?id=<?php echo $row['id']; ?>" 
           class="btn btn-sm btn-danger"
           onclick="return confirm('Yakin ingin menghapus kendaraan ini?');">
            <i class="fas fa-trash-alt"></i> Hapus
        </a>
    <?php } ?>
</td>

                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar" id="sidebar">
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
