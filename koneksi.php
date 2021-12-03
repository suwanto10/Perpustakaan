<?php 
    $server = "10.0.0.71"; 
    $user = "suwanto10"; 
    $password = "Suw4nt0101119$"; 
    $nama_database = "dbpus"; 

    $db = mysqli_connect($server, $user, $password, $nama_database); 
    if( !$db ) {
        die("Gagal terhubung dengan database: " . mysqli_connect_error()); 
    }
?>