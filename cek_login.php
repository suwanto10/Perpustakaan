<?php 
session_start();                // menjalankan session PHP, rekomendasi ditulis di baris paling awal kode program 
$_SESSION['sesi'] = NULL;       // Set variabel global $_SESSION 
    
include "koneksi.php";          // menyisipkan/memanggil file koneksi.php untuk koneksi data dengan basis data 
    
if(isset($_POST['submit'])){   // cek apakah ada request POST yang masuk 
    
    $user   = isset($_POST['user']) ? $_POST['user'] : ""; 
    $pass   = isset($_POST['pass']) ? $_POST['pass'] : ""; 
    $qry    = mysqli_query($db,"SELECT * FROM admin WHERE username = '$user' AND password = '$pass'"); 
    $sesi   = mysqli_num_rows($qry);

    if ($sesi == 1) {            // jika hasil query terdapat 1 baris data (terdapat data yang dicari pada DB) 
    
        $data_admin = mysqli_fetch_array($qry); 
        $_SESSION['idadmin'] = $data_admin['idadmin'];   // set variabelglobal $_SESSION 
        $_SESSION['sesi'] = $data_admin['nm_admin']; 
    
        echo "<script>alert('Anda berhasil Log In');</script>"; 
        echo "<meta http-equiv='refresh' content='0; url=index.php?user=$sesi'>"; 
        
    } else { 
        echo "<meta http-equiv='refresh' content='0; url=login.php'>"; 
        echo "<script>alert('Anda Gagal Log In');</script>"; 
    }

} else { 
    include "login.php";        // jika tidak ada request POST yang masuk, alihkan ke form login 
}    
?>