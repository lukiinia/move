Aplikasi Monitoring Kendaraan

Informasi Akun

Berikut adalah daftar username dan password default untuk menggunakan aplikasi ini:

Username

Password

Role

admin

admin123

Admin

approver1

approver123

Approver

approver2

approver123

Approver

user

user123

User

Informasi Teknologi

Versi Database: MariaDB 10.4.32

Versi PHP: 8.2.12

Framework: Tidak menggunakan framework, aplikasi berbasis PHP native.

Frontend: Menggunakan Bootstrap untuk desain antarmuka.

Panduan Penggunaan Aplikasi

Persiapan Database

Pastikan Anda memiliki server lokal seperti XAMPP atau Laragon.

Impor file database SQL ke dalam MySQL/MariaDB. Nama database adalah kendaraan_monitoring.

File SQL sudah mencakup semua tabel berikut:

approvals

bookings

driver

log_activity

users

Pengaturan Server Lokal

Pastikan server lokal Anda mendukung PHP versi 8.2.12 dan MariaDB versi 10.4.32.

Pastikan semua file aplikasi berada dalam folder htdocs (untuk XAMPP) atau direktori server Anda.

Login ke Aplikasi

Akses aplikasi melalui browser dengan URL seperti http://localhost/nama-folder-aplikasi.

Masuk menggunakan akun default di atas sesuai dengan role Anda.

Fitur Utama

Admin: Dapat mengelola data kendaraan, booking, dan user.

Approver: Dapat menyetujui atau menolak permintaan booking kendaraan.

User: Dapat melakukan booking kendaraan.

Proses Booking Kendaraan

Isi formulir dengan nama pelanggan dan tanggal pemesanan.

Pilih kendaraan dari daftar.

Pilih pengemudi yang tersedia.

Lakukan submit untuk menyimpan data booking.

Proses Persetujuan

Admin atau Approver dapat menyetujui atau menolak permintaan booking dari halaman all-booking.php.

Status akan diperbarui setelah kedua Approver memberikan keputusan.

Laporan

Admin dapat melihat laporan penggunaan kendaraan secara berkala dan mengunduhnya dalam format Excel.

Catatan

Setelah instalasi, disarankan untuk mengganti password default untuk keamanan.

Pastikan koneksi database di file konfigurasi db.php sudah sesuai dengan pengaturan lokal Anda.

Selamat menggunakan aplikasi!#   m o v e  
 