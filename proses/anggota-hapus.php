<?php 
    include '../koneksi.php'; // menyisipkan/memanggil file koneksi.php untuk koneksi data dengan basis data 
    
    $id_anggota = $_GET['id']; 
    
    mysqli_query($db,"DELETE FROM tbanggota WHERE idanggota = '$id_anggota'"); 
    
    header("location:../index.php?p=anggota"); 
?> 
