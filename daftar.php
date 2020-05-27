<?php
include "config.php";
require "registrasi.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
        .bg-black {
            background: #000;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-md bg-black navbar-dark sticky-top">
        <a class="navbar-brand" href="#">Bukaapa.com</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="true">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navb" class="navbar-collapse collapse hide">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
            </ul>

            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                <a class="btn btn-outline-light" href="keranjang.php">Keranjang <span class="fas fa-shopping-cart"></span> <span class="badge bg-light text-dark"><?php if(isset($_SESSION["keranjang"])) { echo count($_SESSION["keranjang"]); } else { echo '0';}?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="daftar.php"><span class="fas fa-user"></span> Daftar</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-info navbar-btn" href="masuk.php"><span class="fas fa-sign-in-alt"></span> Masuk</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Start form-->
    <div class="kotak">
        <section class="form-box">
            <h2>Regitrasi</h2>
            <form action="" method="POST">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nama Depan" name="namaDepan" id="namaDepan" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nama Belakang" name="namaBelakang" id="namaBelakang" required>
                    </div>
                </div>
                <div>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Nama Pengguna" required>
                </div>

                <div><input type="password" class="form-control" name="password" id="password" placeholder="Password" required></div>
                <div><input type="password" class="form-control" name="password2" id="password2" placeholder="Konfirmasi Password" required></div>
                <div>
                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required>
                </div>
                <div><a href="masuk.php" class="nav-link">Sudah punya akun?</a></div>
                <input type="submit" value="Daftar" class="btn btn-info w-100" name="daftar">

            </form>
        </section>
    </div>
    <!-- End form-->
    <?php
    if(isset($_POST['daftar']))
    {
    
    if(regitrasi($_POST) > 0)
    {
        echo '<script>
                alert("User baru telah ditambahkan");
            </script>';
        header('location: masuk.php')  ;
        exit;
    } else {
        echo mysqli_error($con);
    }
    

    }
    ?>
</body>

</html>