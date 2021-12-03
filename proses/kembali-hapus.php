<?php 
    include '../koneksi.php'; // menyisipkan/memanggil file koneksi.php untuk koneksi data dengan basis data 
    
    $id_transaksi= $_GET['id']; 
    
    mysqli_query($db,"DELETE FROM tbtransaksi
    WHERE idtransaksi = '$id_transaksi'"); 
    
    header("location:../index.php?p=transaksi-pengembalian"); 
?> 
