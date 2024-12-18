<?php
session_start();
// Koneksi ke database
include 'db.php'; // Pastikan sudah menghubungkan ke database

// Query untuk mendapatkan jumlah booking yang disetujui per hari
$query = "SELECT DAYNAME(booking_date) AS hari, COUNT(*) AS jumlah_booking 
          FROM bookings 
          WHERE status = 'approved' 
          GROUP BY DAYNAME(booking_date) 
          ORDER BY FIELD(DAYNAME(booking_date), 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
$result = mysqli_query($conn, $query);

$jumlahKendaraanQuery = "SELECT COUNT(*) AS jumlah_kendaraan FROM vehicles";
$resultKendaraan = $conn->query($jumlahKendaraanQuery); // Ganti $koneksi dengan $conn
$jumlahKendaraan = $resultKendaraan->fetch_assoc()['jumlah_kendaraan'];

// Query untuk jumlah driver
$jumlahDriverQuery = "SELECT COUNT(*) AS jumlah_driver FROM driver WHERE status = 'Aktif'";
$resultDriver = $conn->query($jumlahDriverQuery); // Ganti $koneksi dengan $conn
$jumlahDriver = $resultDriver->fetch_assoc()['jumlah_driver'];

// Query untuk jumlah booking
$jumlahBookingQuery = "SELECT COUNT(*) AS jumlah_booking FROM bookings";
$resultBooking = $conn->query($jumlahBookingQuery); // Ganti $koneksi dengan $conn
$jumlahBooking = $resultBooking->fetch_assoc()['jumlah_booking'];

// Query untuk jumlah booking yang diapproved
$jumlahBookingApprovedQuery = "SELECT COUNT(*) AS jumlah_booking_approved FROM bookings WHERE status = 'approved'";
$resultBookingApproved = $conn->query($jumlahBookingApprovedQuery); // Ganti $koneksi dengan $conn
$jumlahBookingApproved = $resultBookingApproved->fetch_assoc()['jumlah_booking_approved'];

// Menyusun data untuk chart
$approvedBookingsData = array_fill(0, 7, 0); // Array untuk menyimpan jumlah booking per hari
$daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]; // Hari dalam seminggu

while ($row = mysqli_fetch_assoc($result)) {
    $dayIndex = array_search($row['hari'], $daysOfWeek); // Menentukan index berdasarkan nama hari
    if ($dayIndex !== false) {
        $approvedBookingsData[$dayIndex] = $row['jumlah_booking']; // Menyimpan jumlah booking ke index yang sesuai
    }
}

// Menutup koneksi
mysqli_close($conn);
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
                    <div class="row">
                        
                    </div>
                </div>
                
                <div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card board1 fill">
            <div class="card-body">
                <div class="dash-widget-header">
                    <div>
                        <h3 class="card_widget_header"><?php echo $jumlahKendaraan; ?></h3>
                        <h6 class="text-muted">Jumlah Kendaraan</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck">
                                <path d="M16 18v-6h4l5 5v4h-9z"></path>
                                <path d="M7 5h7V4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v1z"></path>
                                <path d="M7 13v-3H5v3h2zm1 0h4v-3H8v3z"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card board1 fill">
            <div class="card-body">
                <div class="dash-widget-header">
                    <div>
                        <h3 class="card_widget_header"><?php echo $jumlahDriver; ?></h3>
                        <h6 class="text-muted">Jumlah Driver</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M16 12a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card board1 fill">
            <div class="card-body">
                <div class="dash-widget-header">
                    <div>
                        <h3 class="card_widget_header"><?php echo $jumlahBooking; ?></h3>
                        <h6 class="text-muted">Jumlah Booking</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                <rect x="3" y="4" width="18" height="16" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card board1 fill">
            <div class="card-body">
                <div class="dash-widget-header">
                    <div>
                        <h3 class="card_widget_header"><?php echo $jumlahBookingApproved; ?></h3>
                        <h6 class="text-muted">Booking yang Diapproved</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                                <path d="M9 11l3 3l8-8"></path>
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                <div class="card-body">
    <div class="row">
    </div>
    <div class="card shadow rounded-0">
        <div class="card-header rounded-0">
            <div class="d-flex justify-content-between">
                <div class="card-title flex-shrink-1 flex-grow-1">Bar Chart</div>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <canvas id="bar_chart"></canvas>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="assets/js/script.js"></script>


    <!-- Chart.js Script -->
     <!-- Chart.js Script -->
<script>
    // Data dari PHP
    var approvedCount = <?php echo $approvedCount; ?>;

    // Data chart
    var ctx = document.getElementById('bar_chart').getContext('2d');
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Minggu Ini'], // Label untuk sumbu X (Waktu)
            datasets: [{
                label: 'Jumlah Booking Approved',
                data: [approvedCount], // Data yang akan ditampilkan
                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Warna batang
                borderColor: 'rgba(75, 192, 192, 1)', // Warna border batang
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
// Data dari PHP untuk chart
var approvedBookingsData = <?php echo json_encode($approvedBookingsData); ?>; // Data dari PHP
var daysOfWeek = <?php echo json_encode($daysOfWeek); ?>; // Hari dalam seminggu

// Chart.js configuration
var ctx = document.getElementById('bar_chart').getContext('2d');
var barChart = new Chart(ctx, {
    type: 'bar', // Tipe chart (bar chart)
    data: {
        labels: daysOfWeek, // Label sumbu x (hari-hari dalam seminggu)
        datasets: [{
            label: 'Approved Bookings',
            data: approvedBookingsData, // Data untuk chart
            backgroundColor: '#009688', // Warna batang
            borderColor: '#00695c',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true // Memastikan sumbu y dimulai dari 0
            }
        }
    }
});
</script>

   

</body>

</html>
