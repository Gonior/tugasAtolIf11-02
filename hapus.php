<?php
include "config.php";
session_start();

if( !isset($_SESSION['login']))
{
    header('location: masuk.php');
}

$id = $_GET['id'];

$sql = "DELETE FROM `produk` WHERE `produk`.`id_produk` = $id";

$queyHapus= mysqli_query($con,$sql);

if($queyHapus){
    header('location:profil.php');
}
else {
    echo 'Something Error';
}

