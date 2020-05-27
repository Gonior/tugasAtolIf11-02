<?php
session_start();
include 'config.php';
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
<div class="container">
            <?php 
        if(empty($_SESSION['keranjang'])):?>
        <div class="d-flex justify-content-center">
            <h1 class="display-4">Tidak Ada Item Dalam Keranjang</h1>
        </div>
        <?php endif; ?>
    <div class="row" id="tabel_order">


        <?php if(!empty($_SESSION['keranjang'])):?>
        <table class="table table-borderless">  
                <tr>  
                    <th width="20%" >Nama Produk</th>  
                    <th width="20%">Image</th>  
                    <th width="10%">Jumlah</th>  
                    <th width="20%" style="text-align:right;">Harga</th>  
                    <th width="15%" style="text-align:right;">Total</th>  
                    <th width="5%">Aksi</th>  
                </tr>  
        <?php foreach ($_SESSION['keranjang'] as $key => $values) {?>
            <tr>  
                <td><?=$values["nama"] ?></td>  
                <td><img src="images/<?= $values['gambar'];?>" class="img-thumbnail" style="width:100px;height:100px;"></td>
                <td><input type="text" name="quantity[]" id="<?=$values["id"] ?>" value="<?=$values["jumlah"] ?>" class="form-control jumlah" data-id="<?=$values["id"] ?>" /></td>  
                <td align="right">Rp <?=$values["harga"] ?></td>  
                <td align="right">Rp <?=number_format($values["jumlah"] * $values["harga"], 0) ?></td>  
                <td><button name="delete" class="btn btn-danger btn-xs hapus" id="<?=$values["id"] ?>">Hapus</button></td>  
            </tr>  
    <?php } ?>
                    <tr>  
                    <td colspan="3" align="right">Total</td>  
                    <td align="right">Rp <?php echo number_format($_SESSION['total'], 0)?></td>  
                    <td></td>  
                </tr>  
                <tr>  
                    <td colspan="5" align="center">  
                        <form method="post" action="cart.php">  
                            <input type="submit" name="place_order" class="btn btn-warning" value="Order.." />  
                        </form>  
                    </td>  
                </tr>  
            </table>
        <?php endif; 
?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    $(".add_to_cart").click(function(){
        var id = $(this).attr('id');
        var nama  = $('#nama_produk'+id).val();
        var harga = $('#harga_produk'+id).val();
        var jumlah = $('#jumlah_produk'+id).val();
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
                    jumlah : jumlah
                    },
                    success:function(data){
                        $('#tabel_order').html(data.tabel_order);
                        $('#badge').text(data.jumlah);
                        alert('Berhasil menambahkan ke keranjang!');
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
                        location.reload(true);
                    }

                });
                alert("Item Berhasil Dihapus!");
            } 
        });
        $(document).on('keyup', '.jumlah', function(){  
           var id = $(this).attr('id');  
           var jumlah = $(this).val();  
           var action = "edit_jumlah";  
           if(jumlah != '')  
           {  
                $.ajax({  
                     url :"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{id:id,jumlah:jumlah, action:action},  
                     success:function(data){  
                          location.reload(true);
                     }  
                });  
           }  
      }); 
    });
</script>
</body>
</html>