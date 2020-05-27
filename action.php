<?php

session_start();
//penamabahan ke dalam keranjanng

if(isset($_POST['id']))
{
    $order_table = '';  
    $message = '';  
    if($_POST['action'] == "tambah") 
    {
        if(isset($_SESSION['keranjang']))
        {
            $ada = 0;
            foreach($_SESSION['keranjang'] as $key => $value) 
            {
                if ($_SESSION['keranjang'][$key]['id'] == $_POST['id']) 
                {
                    $ada++;
                    $_SESSION['keranjang'][$key]['jumlah'] = $_SESSION['keranjang'][$key]['jumlah'] + $_POST['jumlah'];
                }
            }
            if($ada < 1)
            {
                $item_array = array(
                    'id' => $_POST['id'],
                    'nama' => $_POST['nama'],
                    'harga' => $_POST['harga'],
                    'gambar' => $_POST['gambar'],
                    'jumlah' => $_POST['jumlah']);
                $_SESSION['keranjang'][] = $item_array;
            }
        } 
        else 
        {
            $item_array = array(
                    'id' => $_POST['id'],
                    'nama' => $_POST['nama'],
                    'harga' => $_POST['harga'],
                    'gambar' => $_POST['gambar'],
                    'jumlah' => $_POST['jumlah']
                );
                $_SESSION['keranjang'][] = $item_array;
        }
    }
    if($_POST['action'] == "hapus")
    {
        foreach ($_SESSION['keranjang'] as $key => $value) 
        {
            if($_SESSION['keranjang'][$key]['id'] == $_POST['id'])
            {
                unset($_SESSION['keranjang'][$key]);
            }
        }
    }
    if($_POST["action"] == "edit_jumlah")  
      {  
           foreach($_SESSION["keranjang"] as $keys => $values)  
           {  
                if($_SESSION["keranjang"][$keys]['id'] == $_POST["id"])  
                {  
                     $_SESSION["keranjang"][$keys]['jumlah'] = $_POST["jumlah"];  
                }  
           }  
      }  
    if(!empty($_SESSION["keranjang"]))  
      {  
           $total = 0;  
           foreach($_SESSION["keranjang"] as $keys => $values)  
           {  

                $total = $total + ($values["jumlah"] * $values["harga"]);
                $_SESSION['total']  = $total;
           }  
    }  else {
        $_SESSION['total'] = 0;   
    }
        $hasil = array(
        'jumlah' => count($_SESSION['keranjang'])
    );
    echo json_encode($hasil);
}
?>