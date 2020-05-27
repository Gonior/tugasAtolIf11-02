<?php
session_start();

include ('config.php');

$query = mysqli_query($con,"SELECT * FROM produk") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
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
                    <a class="btn btn-outline-light" href="keranjang.php">Keranjang <span class="fas fa-shopping-cart"></span> <span class="badge bg-light text-dark" id="badge"><?php if(isset($_SESSION["keranjang"])) { echo count($_SESSION["keranjang"]); } else { echo '0';}?></span></a>
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
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1>Bootstrap Tutorial</h1>
            <p>Bootstrap is the most popular HTML, CSS...</p>
        </div>
    </div>
    <div class="container">
    <div class="row">
            <?php
    if(mysqli_num_rows($query) == 0){
        echo '
        <div class="container text-center">
            <h3>Produk belum ada,</h3>
        </div>';
    } else
    {
    while($hasil = mysqli_fetch_array($query)):?>
            <div class="col-md-4">
                <div class="caption">
                    <h3 class="text-center text-info">
                        <?= $hasil['nama_produk']; ?>
                    </h3>
                    <div class="thumbnail">
                        <img class="img-thumbnail" src="images/<?= $hasil['gambar_produk']; ?>"
                        style="width:400px;height:400px; margin-bottom:5px;">
                    </div>
                    <p>
                        <input type="text" name="jumlah_produk" id="jumlah_produk<?= $hasil["id_produk"]; ?>" class="form-control" value="1" />
                    </p>
                    <p>
                        <?= $hasil['deskripsi_produk'];?>
                    </p>
                    <h5 class="text-info">Rp
                        <?= number_format($hasil['harga_produk'],0);?>
                    </h5>
                    <p>
                    <input type="hidden" name="hidden_gambar" id="gambar_produk<?= $hasil['id_produk'];?>" value="<?= $hasil['gambar_produk']; ?>">
                    <input type="hidden" name="hidden_nama" id="nama_produk<?= $hasil["id_produk"]; ?>" value="<?= $hasil["nama_produk"]; ?>" />  
                    <input type="hidden" name="hidden_harga" id="harga_produk<?= $hasil["id_produk"]; ?>" value="<?= $hasil["harga_produk"]; ?>" />  
                    <input type="button" name="add_to_cart" id="<?= $hasil["id_produk"]; ?>" style="margin-top:5px;" class="btn btn-warning form-control add_to_cart" value="Add to Cart" /> 
                        <!-- <a href="#" class="btn btn-warning w-100 add_to_cart" role="button">
                            Tambah ke keranjang
                        </a> -->

                    </p>

                </div>
            </div>
            <?php
    endwhile;
    }

    
    ?>
    <div class="container">
    <div class="row" id="tabel_order">

</div>
</body>
<script>
$(document).ready(function(){
    $(".add_to_cart").click(function(){
        var id = $(this).attr('id');
        var nama  = $('#nama_produk'+id).val();
        var harga = $('#harga_produk'+id).val();
        var jumlah = $('#jumlah_produk'+id).val();
        var gambar = $('#gambar_produk'+id).val();
        var action = "tambah";
        if(jumlah > 0){
            $.ajax({
                url : "action.php",
                dataType : "JSON",
                type : "POST",
                data : {
                    id:id,
                    nama:nama,
                    action:action,
                    harga:harga,
                    gambar : gambar,
                    jumlah : jumlah
                    },
                    success:function(data){
                        $('#tabel_order').html(data.tabel_order);
                        $('#badge').text(data.jumlah);
                        alert('Berhasil menambahkan ke keranjang!')
                    }
                });
        } else
        {
        alert('masukan jumlah');
        }
        });
        $(document).on('click','.hapus',function(){
            var id = $(this).attr('id');
            var action = 'hapus';
            if(confirm("Produk akan dihapus?"))
            {
                $.ajax({
                    url : "action.php",
                    dataType : "JSON",
                    type : "POST",
                    data : {
                        id:id,
                        action:action
                    },
                    success:function(data){
                        $('#badge').text(data.jumlah);
                    }
                });

            } 
        });
    });

</script>
</html>