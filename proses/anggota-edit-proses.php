<?php 
    include '../koneksi.php'; // menyisipkan/memanggil file koneksi.php untuk koneksi data dengan basis data 
    
    $id_anggota = $_POST['id_anggota']; 
    $nama = $_POST['nama']; 
    $jenis_kelamin = $_POST['jenis_kelamin']; 
    $alamat = $_POST['alamat']; 
    
    if(isset($_POST['simpan'])) { // cek jika ada form yang di submit 
        extract($_POST); 
        $nama_file = $_FILES['foto']['name']; 
    
        if(!empty($nama_file)){ 
            // Baca lokasi file sementara dan nama file dari form (upload) 
            $lokasi_file = $_FILES['foto']['tmp_name']; 
            $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION); 
            $file_foto = $id_anggota.".".$tipe_file; 
    
            $folder = "../images/$file_foto"; // Tentukan folder untuk menyimpan file 
            @unlink ("$folder"); // hapus foto yang lama, tanda @ untuk menyembunyikan pesan warning, jika file tidak ditemukan 
            move_uploaded_file($lokasi_file,"$folder"); // Apabila file berhasil di upload 
        } else {
            $file_foto=$foto_awal; 
        } 
    
        mysqli_query($db, "UPDATE tbanggota 
                            SET nama='$nama', jeniskelamin='$jenis_kelamin', alamat='$alamat', foto='$file_foto' 
                            WHERE idanggota = '$id_anggota'"); 
    
        header("location:../index.php?p=anggota"); 
    }
?>