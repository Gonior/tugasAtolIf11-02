<?php
session_start();

if( !isset($_SESSION['login']))
{
    header('location: masuk.php');

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
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
    <ul class="nav justify-content-center nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="profil.php">List Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tambah.php">Tambah Produk</a>
        </li>
    </ul>
    <?php
    include "config.php";
    $id = $_GET['id'];
    $sql = "SELECT * FROM `produk` WHERE produk.id_produk = $id";
    $query = mysqli_query($con,$sql);
    $res = mysqli_fetch_array($query);
    ?>
<div class="container">
    <h3 class="text-center">Edit produk</h3>
        <div class="col-md-9">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama produk</label>
                    <input type="text" class="form-control" id="namaProduk" name="namaProduk" value="<?= $res['nama_produk']?>">
                </div>
                <div class="form-group">
                    <label for="hargaProduk">Harga produk</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" class="form-control" id="hargaProduk" name="hargaProduk" value="<?= $res['harga_produk']?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsiProduk">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsiProduk" name="deskripsiProduk" value="<?= $res['deskripsi_produk']?>">
                </div>
                <input type="submit" value="Edit" name="edit" class="btn btn-info">

            </form>
        </div>
    </div>
<?php
if(isset($_POST['edit'])) {
    $nama_produk = $_POST['namaProduk'];
    $harga_produk = $_POST['hargaProduk'];
    $deskripsi_produk = $_POST['deskripsiProduk'];

    $queryUpdate = mysqli_query($con, "UPDATE `produk` SET `nama_produk` = '$nama_produk', `harga_produk` = '$harga_produk', `deskripsi_produk` = '$deskripsi_produk' WHERE `produk`.`id_produk` = $id");

    if($queryUpdate) {
        echo '<h1 class="text-center">Data Berhasil diedit</h1>';
        echo '<meta http-equiv="refresh" content="1">';
    } else
    {
        echo "Something wrong..";
    }
}

?>
</body>


</html>