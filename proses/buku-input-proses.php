<?php 
include '../koneksi.php'; // menyisipkan/memanggil file koneksi.php untuk koneksi data dengan basis data 

$id_buku=$_POST['id_buku'];
$judul_buku=$_POST['judul_buku'];
$kategori=$_POST['kategori'];
$pengarang=$_POST['pengarang'];
$penerbit=$_POST['penerbit'];
$jumlahbuku=$_POST['jumlahbuku'];
$status="Tersedia";
 
if(isset($_POST['simpan'])) { 
    extract($_POST); 
    $nama_file = $_FILES['foto']['name']; 

    if(!empty($nama_file)) { 
        // Baca lokasi file sementara dan nama file dari form (upload) 
        $lokasi_file = $_FILES['foto']['tmp_name']; 
        $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION); 
        $file_foto = $id_buku.".".$tipe_file; 

        $folder = "../images/$file_foto"; // Tentukan folder untuk menyimpan file 
        move_uploaded_file($lokasi_file,"$folder"); // Apabila file berhasil di upload 
    } else { 
        $filefoto="-"; 
    } 
    
    $sql = "INSERT INTO tbbuku VALUES('$id_buku','$judul_buku','$kategori','$pengarang','$penerbit','$jumlahbuku','$status','$file_foto')"; 
    $query = mysqli_query($db, $sql); 

    header("location:../index.php?p=buku");
}
?> 
