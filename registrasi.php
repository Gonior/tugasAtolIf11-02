<?php
session_start();

function regitrasi($data) {
    global $con;
    $namaDepan = strtolower(stripcslashes($data['namaDepan']));
    $namaBelakang = strtolower(stripcslashes($data['namaBelakang']));
    $alamat = strtolower(stripcslashes($data['alamat']));
    $username = strtolower(stripcslashes($data['username']));
    $password = mysqli_real_escape_string($con,$data['password']);
    $password2 = mysqli_real_escape_string($con,$data['password2']);
    
    
    // cek konfirmasi password
    if( $password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai');
                </script>";
        return false;
    } 
    //cek usename yang sudah ada atau belum
    $result = mysqli_query($con,"SELECT username FROM user WHERE username = '$username' ");
    if(mysqli_fetch_assoc($result)) {
        echo '<script>
            alert("username yang dipilih sudah terdaftar!");
            </script>';
        return false;
    }
    //enkripsi password
    $password= password_hash($password,PASSWORD_DEFAULT);
    //menambah user ke database
    mysqli_query($con,"INSERT INTO user VALUES('','$namaDepan','$namaBelakang','$username','$password','$alamat')");

    return mysqli_affected_rows($con);
}

