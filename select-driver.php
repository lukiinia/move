<?php
session_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['selected_vehicle'])) {
    header('Location: all-vehicles.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['driver_id'])) {
    include 'db.php';

    $driver_id = $_POST['driver_id'];

    $stmt = $conn->prepare("SELECT * FROM driver WHERE id_driver = ? AND status = 'Aktif'");
    $stmt->bind_param("i", $driver_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $driver = $result->fetch_assoc();
        $_SESSION['selected_driver'] = [
            'id' => $driver['id_driver'],
            'name' => htmlspecialchars($driver['nama_driver']),
            'phone' => htmlspecialchars($driver['no_telepon'])
        ];

        header('Location: finish-booking.php');
        exit;
    } else {
        echo "Driver tidak ditemukan atau tidak aktif.";
    }
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
                            <h3 class="page-title mt-5">Pilih Driver</h3> 
                        </div>
                    </div>
                </div>
                
                <?php if (isset($_SESSION['selected_vehicle'])): ?>
                    <div class="card mb-4">
                        <img class="card-img-top" src="uploads/<?php echo htmlspecialchars($_SESSION['selected_vehicle']['photo']); ?>" style="height: 200px; object-fit: cover;" alt="Foto Kendaraan">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($_SESSION['selected_vehicle']['name']); ?></h5>
                            <p class="card-text">Tipe: <?php echo htmlspecialchars($_SESSION['selected_vehicle']['type']); ?></p>
                            <p class="card-text">Status: <?php echo htmlspecialchars($_SESSION['selected_vehicle']['status']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body booking_card">
                                <div class="table-responsive">
                                    <form action="" method="POST">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID Driver</th>
                                                    <th>Nama Driver</th>
                                                    <th>No. Telepon</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include 'db.php'; 

                                                $query = "SELECT * FROM driver WHERE status = 'Aktif'";
                                                $result = mysqli_query($conn, $query);

                                                while ($driver = mysqli_fetch_assoc($result)) {
                                                    echo '<tr>';
                                                    echo '<td>' . $driver['id_driver'] . '</td>';
                                                    echo '<td>' . htmlspecialchars($driver['nama_driver']) . '</td>';
                                                    echo '<td>' . htmlspecialchars($driver['no_telepon']) . '</td>';
                                                    echo '<td>';
                                                    echo '<input type="radio" name="driver_id" value="' . $driver['id_driver'] . '" required>';
                                                    echo '<input type="hidden" name="driver_name" value="' . htmlspecialchars($driver['nama_driver']) . '">';
                                                    echo '<input type="hidden" name="driver_phone" value="' . htmlspecialchars($driver['no_telepon']) . '">';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-success">Selesaikan Pesanan</button>
                                    </form>
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


   
</body>

</html>
