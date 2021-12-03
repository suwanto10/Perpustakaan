<?php 
include '../koneksi.php'; // menyisipkan/memanggil file koneksi.php untuk koneksi data dengan basis data 

$id_anggota = $_POST['id_anggota']; 
$nama = $_POST['nama']; 
$jenis_kelamin = $_POST['jenis kelamin']; 
$alamat = $_POST['alamat']; 
$status = "Tidak Meminjam";
 
if(isset($_POST['simpan'])) { 
    extract($_POST); 
    $nama_file = $_FILES['foto']['name']; 

    if(!empty($nama_file)) { 
        // Baca lokasi file sementara dan nama file dari form (upload) 
        $lokasi_file = $_FILES['foto']['tmp_name']; 
        $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION); 
        $file_foto = $id_anggota.".".$tipe_file; 

        $folder = "../images/$file_foto"; // Tentukan folder untuk menyimpan file 
        move_uploaded_file($lokasi_file,"$folder"); // Apabila file berhasil di upload 
    } else { 
        $filefoto="-"; 
    } 
    
    $sql = "INSERT INTO tbanggota VALUES('$id_anggota','$nama','$jenis_kelamin','$alamat','$status','$file_foto')"; 
    $query = mysqli_query($db, $sql); 

    header("location:../index.php?p=anggota");
}
?> 
