<?php 
session_start();
include 'config.php';
if(isset($_POST['masuk']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $hasil = mysqli_query($con,"SELECT * FROM user WHERE username = '$username'");
    
    if(mysqli_num_rows($hasil) === 1)
    {
        $row = mysqli_fetch_assoc($hasil);
        if( password_verify($password,$row['password'])) {
            //set session
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $row['id'];
            $_SESSION['user'] = $row['nama_depan'];
            $_SESSION['author'] = $row['username'];
            header('location: index.php');
            exit;
        }
    }
    $error = true;
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
                    <a class="btn btn-info navbar-btn" href="#"><span class="fas fa-sign-in-alt"></span> Masuk</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Start form-->
    <div class="kotak-login">
    <?php if(isset($error)) :?>
    <h4 class="text-center" style="color:red;">Password / username Salah</h4>
    <?php endif;?>
        <section class="form-box">
            <h2>Login </h2>
            <form action="" method="POST">
            
                <input type="text" name="username" id="username" class="form-control" placeholder="Nama Pengguna" required>
                
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <div><a href="daftar.php" class="nav-link">Belum punya akun?</a></div>
                <input type="submit" value="Masuk" class="btn btn-info w-100" name="masuk">
            </form>
        </section>
    </div>
    
    <!-- End form-->
</body>

</html>