<?php 
    include "../koneksi.php"; // menyisipkan/memanggil file koneksi.php untuk koneksi data dengan basis data 
?> 
<link rel="stylesheet" type="text/css" href="../style.css"> 
<h3>Data Anggota</h3> 
<div id="content"> 
    <table border="1" id="tabel-tampil">
        <thead> 
            <tr> 
                <th id="label-tampil-no">No</th> 
                <th>ID Anggota</th> 
                <th>Nama</th> 
                <th>Foto</th> 
                <th>Jenis Kelamin</th> 
                <th>Alamat</th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php 
                $nomor = 1; 
                $query = "SELECT * FROM tbanggota ORDER BY idanggota DESC"; 
                $q_tampil_anggota = mysqli_query($db, $query); 

                if(mysqli_num_rows($q_tampil_anggota) > 0) { 
                    // looping semua data pada tabel tbanggota 
                    while($r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota)) { 
                        if(empty($r_tampil_anggota['foto']) or ($r_tampil_anggota['foto'] == '-')) {
                            $foto = "admin-no-photo.jpg"; 
                        } else { 
                            $foto = $r_tampil_anggota['foto']; 
                        }
            ?>
            <tr>
                <td><?php echo $nomor; ?></td> 
                <td><?php echo $r_tampil_anggota['idanggota']; ?></td> 
                <td><?php echo $r_tampil_anggota['nama']; ?></td> 
                <td><img src="https://objectstorage.us-ashburn-1.oraclecloud.com/n/idqunajpebii/b/UtsSuwanto/o/images%2F<?php echo $foto; ?>" width="70px" height="70px"></td> 
                <td><?php echo $r_tampil_anggota['jeniskelamin']; ?></td> 
                <td><?php echo $r_tampil_anggota['alamat']; ?></td> 
            </tr> 
            <?php 
                        $nomor++; 
                    } // end looping 
                } // end if 
            ?> 
    </table> 
    <script> 
        window.print(); 
    </script> 
</div> 

