<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Monitoring</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <form action="login_process.php" method="POST" autocomplete="off" class="sign-in-form">
                        <div class="logo">
                            <img src="BARUUUUUUUU.svg" alt="vehicle-monitoring" />
                        </div>

                        <div class="heading">
                            <h2>Selamat Datang</h2>
                        </div>

                        <!-- Menampilkan pesan error jika ada -->
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['error']; ?>
                                <?php unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="username" minlength="4" class="input-field" autocomplete="off" required />
                                <label>Nama Pengguna</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password" minlength="4" class="input-field" autocomplete="off" required />
                                <label>Kata Sandi</label>
                            </div>

                            <input type="submit" value="Masuk" class="sign-btn" />

                            <p class="text">
                                Lupa kata sandi atau data login Anda?
                                <a href="#">Dapatkan bantuan</a> untuk masuk
                            </p>
                        </div>
                    </form>
                </div>

                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="./img/image1.png" class="image img-1 show" alt="tracking" />
                        <img src="./img/image2.png" class="image img-2" alt="vehicle monitoring" />
                        <img src="./img/image3.png" class="image img-3" alt="vehicle tracking" />
                    </div>

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Pantau lokasi kendaraan secara real-time</h2>
                                <h2>Periksa status kendaraan Anda setiap saat</h2>
                                <h2>Kelola armada kendaraan Anda dengan mudah</h2>
                            </div>
                        </div>

                        <div class="bullets">
                            <span class="active" data-value="1"></span>
                            <span data-value="2"></span>
                            <span data-value="3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="app.js"></script>
</body>

</html>
