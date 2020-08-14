<?php


$host = "localhost";
$user = "root";
$pw = '';
$db = "shop";

$con = mysqli_connect($host,$user,$pw,$db);
if(mysqli_connect_errno()) 
{
    echo "Gagal terhubung ".mysqli_connect_errno();
}

?>