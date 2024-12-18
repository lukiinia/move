<?php
// Pastikan untuk memuat autoloader jika menggunakan Composer
require 'vendor/autoload.php'; 
include('db.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Ambil data pemesanan dari database
$query = "SELECT b.id, b.customer_name, b.booking_date, v.name AS vehicle_name, v.foto AS vehicle_image, d.nama_driver, b.status, b.created_at
          FROM bookings b
          JOIN vehicles v ON b.vehicle_id = v.id
          JOIN driver d ON b.driver_id = d.id_driver";

$result = mysqli_query($conn, $query);
$bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Buat spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header untuk kolom
$sheet->setCellValue('A1', 'ID Pemesanan');
$sheet->setCellValue('B1', 'Nama Pelanggan');
$sheet->setCellValue('C1', 'Nama Kendaraan');
$sheet->setCellValue('D1', 'Tanggal Pemesanan');
$sheet->setCellValue('E1', 'Nama Driver');
$sheet->setCellValue('F1', 'Status');
$sheet->setCellValue('G1', 'Tanggal Dibuat');

// Isi data pemesanan pada file Excel
$row = 2;
foreach ($bookings as $booking) {
    $sheet->setCellValue('A' . $row, $booking['id']);
    $sheet->setCellValue('B' . $row, $booking['customer_name']);
    $sheet->setCellValue('C' . $row, $booking['vehicle_name']);
    $sheet->setCellValue('D' . $row, $booking['booking_date']);
    $sheet->setCellValue('E' . $row, $booking['nama_driver']);
    $sheet->setCellValue('F' . $row, $booking['status']);
    $sheet->setCellValue('G' . $row, $booking['created_at']);
    $row++;
}

// Set header untuk mengunduh file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="booking_report.xlsx"');
header('Cache-Control: max-age=0');

// Tulis file Excel
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
