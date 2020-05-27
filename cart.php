<?php  
 //cart.php  
 session_start();  
     include "config.php";
     if( !isset($_SESSION['login'])) {
          header('location: masuk.php');
     }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <title>Shop</title>
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
          crossorigin="anonymous">
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
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb"
               aria-expanded="true">
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
                         <a class="btn btn-outline-light" href="keranjang.php">Keranjang <span class="fas fa-shopping-cart"></span>
                              <span class="badge bg-light text-dark" id="badge">
                                   <?php if(isset($_SESSION["keranjang"])) { echo count($_SESSION["keranjang"]); } else { echo '0';}?></span></a>
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
     <br />
     <div class="container" style="width:800px;">
          <?php  
               if(isset($_POST["place_order"]))  
               { 
                    
                    $insert_order = "  
                    INSERT INTO `order`(id_pelanggan, tanggal_order, status)  
                    VALUES('".$_SESSION['id_user']."', '".date("Y-m-d h:i:s")."', 'pending')";  
                    $order_id = "";  
                    if(mysqli_query($con, $insert_order))  
                    {  
                         $order_id = mysqli_insert_id($con);
                    }  
                    $_SESSION["order_id"] = $order_id;  
                    $order_details = "";  
                    foreach($_SESSION["keranjang"] as $keys => $values)  
                    {  
                         $order_details .= "  
                         INSERT INTO order_detail(id_order, nama_produk, harga_produk, jumlah_produk)  
                         VALUES('".$order_id."', '".$values["nama"]."', '".$values["harga"]."', '".$values["jumlah"]."');  
                         ";  
                    }  
                    if(mysqli_multi_query($con, $order_details))  
                    {  
                         unset($_SESSION["keranjang"]);  
                         echo '<script>alert("Pembayaran Sukses.. Terima kasih")</script>';  
                         echo '<script>window.location.href="cart.php"</script>';  
                    }  
               }  
               if(isset($_SESSION["order_id"]))  
               {  
                    $pelanggan = '';  
                    $order_details = '';  
                    $total = 0;
                    $tanggal='';  
                    $query = '  
                    SELECT * FROM `order` INNER JOIN `order_detail` ON `order_detail`.id_order = `order`.id_order INNER JOIN user ON user.id = `order`.id_pelanggan WHERE `order`.id_order = "'.$_SESSION["order_id"].'"  
                    ';  
                    $result = mysqli_query($con, $query);  
                    while($row = mysqli_fetch_array($result))   
                    {  
                         $tanggal = $row["tanggal_order"];
                         $pelanggan = '  
                         <label>'.$row["nama_depan"].' '.$row["nama_belakang"].'</label>  
                         <p>'.$row["alamat"].'</p>
                         <p>'.$row["provinsi"].', '.$row["kode_pos"].'</p>  
                         ';  
                         $order_details .= "  
                              <tr>  
                                   <td>".$row["nama_produk"]."</td>  
                                   <td>".$row["jumlah_produk"]."</td>  
                                   <td>".$row["harga_produk"]."</td>  
                                    <td>".number_format($row["jumlah_produk"] * $row["harga_produk"], 0)."</td>  
                              </tr>  
                         ";  
                          $total = $total + ($row["jumlah_produk"] * $row["harga_produk"]);  
                    }  
                    echo '  
                    <h3 align="center">Order Summary for Order No. '.$_SESSION["order_id"].'</h3>  
                    <h4 align="center">Transaksi berhasil pada <b>'.$tanggal.'</b></h4>  
                    <div class="table-responsive">  
                         <table class="table">  
                              <tr>  
                                   <td><label>Customer Details</label></td>  
                              </tr>  
                              <tr>  
                                   <td>'.$pelanggan.'</td>  
                         </tr>  
                         <tr>  
                         <td><label>Order Details</label></td>  
                         </tr>  
                         <tr>  
                              <td>  
                                   <table class="table table-bordered">  
                                        <tr>  
                                                  <th width="50%">Product Name</th>  
                                                  <th width="15%">Quantity</th>  
                                                  <th width="15%">Price</th>  
                                                  <th width="20%">Total</th>  
                                             </tr>  
                                             '.$order_details.'  
                                             <tr>  
                                                  <td colspan="3" align="right"><label>Total</label></td>  
                                                  <td>'.number_format($total, 0).'</td>  
                                             </tr>  
                                        </table>  
                                   </td>  
                              </tr>  
                         </table>  
                    </div>  
                    ';  
               }  
               ?>
     </div>
</body>

</html>