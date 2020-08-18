<?php
include "config.php";
session_start();
if( !isset($_SESSION['login'])) {
    header('location: masuk.php');
}
$author = $_SESSION["author"];
$query = mysqli_query($con,"SELECT * FROM produk WHERE pemilik = '$author'") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet' />
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
            </ul>

            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                <a class="btn btn-outline-light" href="keranjang.php">Keranjang <span class="fas fa-shopping-cart"></span> <span class="badge bg-light text-dark"><?php if(isset($_SESSION["keranjang"])) { echo count($_SESSION["keranjang"]); } else { echo '0';}?></span></a>
                </li>
                <?php
                if( !isset($_SESSION['login']))
                {
                    echo '
                <li class="nav-item">
                    <a class="nav-link text-white" href="daftar.php"><span class="fas fa-user"></span> Daftar</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-info navbar-btn" href="masuk.php"><span class="fas fa-sign-in-alt"></span> Masuk</a>
                </li>';
                } else 
                {
                echo '<li class="nav-item">
                    <a class="btn btn-info navbar-btn" href="profil.php"><span class="fas fa-user"></span> '.$_SESSION["user"].'</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger navbar-btn" href="keluar.php"><span class="fas fa-sign-out-alt"></span> Keluar</a>
                </li>';
                }
                ?>
            </ul>
        </div>
    </nav>
    <!-- End Navigasi-->
<div class="container-fluid">
    <div class="jumbotron jumbotron-fluid">
            <h1 class="display-4">Hallo <?= $_SESSION['user'];?></h1>
            <p class="lead">Web ini masih dalam tahap pengembangan</p>
        </div>
    </div>
    <div id='map' style='width: 400px; height: 300px;'></div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZGVkaWNhaHlhMjAwMSIsImEiOiJja2R0M2t3ZzEwMHBwMnJuczFmOGJwOG40In0.d3dUet6Nbdm_mUuSdvz3Ig';
        var map = new mapboxgl.Map({
        container: 'map',
        center : {"lng":107.61538749446106,"lat":-6.886579328312294},
        style: 'mapbox://styles/mapbox/streets-v11',
        zoom : 17
        });
    </script>
    <ul class="nav justify-content-center nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="profil.php">List Produk</a>
        </li>
        <li></li>
        <li class="nav-item">
            <a class="nav-link" href="tambah.php">Tambah Produk</a>
        </li>
    </ul>
    <form action="" method="post">
    <div class="container">
    <div class="row">
            <?php
    if(mysqli_num_rows($query) == 0){
        echo '
        <div class="container text-center">
            <h3>Produk belum ada,</h3>
            <a href="tambah.php">tambah produk?</a>
        </div>';
    } else
    {
    while($hasil = mysqli_fetch_array($query)):?>
            <div class="col-md-4">
                <div class="caption">
                    <h3 class="text-center">
                        <?= $hasil['nama_produk']; ?>
                    </h3>
                    <div class="thumbnail">
                        <img class="img-thumbnail" src="images/<?= $hasil['gambar_produk']; ?>"
                        style="width:400px;height:400px;">
                    </div>
                    <p>
                        <?= $hasil['deskripsi_produk'];?>
                    </p>
                    <h5>Rp
                        <?= $hasil['harga_produk'];?>
                    </h5>
                    <p>
                        <a href="edit.php?id=<?= $hasil['id_produk']?>" class="btn btn-primary" role="button">
                            Edit
                        </a>
                        <a href="hapus.php?id=<?= $hasil['id_produk']?>" class="btn btn-danger" role="button" onClick='return confirm("Apakah Ada yakin menghapus?")'>
                            Hapus
                        </a>

                    </p>

                </div>
            </div>
            <?php
    endwhile;
    }
    ?>
    </div>
    </div>
    </form>


</body>

</html>