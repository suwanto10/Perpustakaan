<?php 
    $id_buku = $_GET['id']; 
    $q_tampil_buku = mysqli_query($db,"SELECT * FROM tbbuku WHERE idbuku = '$id_buku'"); 
    $r_tampil_buku = mysqli_fetch_array($q_tampil_buku); 

    if(empty($r_tampil_buku['foto']) or ($r_tampil_buku['foto'] == '-')) { 
        $foto = "admin-no-photo.jpg"; 
    } else { 
        $foto = $r_tampil_buku['foto'];
    }
?> 
<div id="label-page"><h3>Edit Buku</h3></div> 
<div id="content"> 
    <form action="proses/buku-edit-proses.php" method="post" enctype="multipart/form-data"> 
        <table id="tabel-input"> 
            <tr> 
                <td class="label-formulir">FOTO</td> 
                <td class="isian-formulir"> 
                    <img src="https://objectstorage.us-ashburn-1.oraclecloud.com/n/idqunajpebii/b/UtsSuwanto/o/images%2F<?php echo $foto; ?>" width=70px height=75px> 
                    <input type="file" name="foto" class="isian-formulir isian-formulir-border"> 
                    <input type="hidden" name="foto_awal" value="<?php echo $r_tampil_buku['foto']; ?>"> 
                </td> 
            </tr> 
            <tr>
                <td class="label-formulir">ID Buku</td>
                <td class="isian-formulir"><input type="text" name="id_buku" value="<?php echo $r_tampil_buku['idbuku']; ?>" readonly="readonly" class="isian-formulir isian-formulir-border warna-formulir-disabled"></td>
            </tr>
            <tr>
                <td class="label-formulir">Judul Buku</td>
                <td class="isian-formulir"><input type="text" name="judul_buku" value="<?php echo $r_tampil_buku['judulbuku']; ?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir">Kategori</td>
                <td class="isian-formulir"><input type="text" name="kategori" value="<?php echo $r_tampil_buku['kategori']; ?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir">Pengarang</td>
                <td class="isian-formulir"><input type="text" name="pengarang" value="<?php echo $r_tampil_buku['pengarang']; ?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir">Penerbit</td>
                <td class="isian-formulir"><input type="text" name="penerbit" value="<?php echo $r_tampil_buku['penerbit']; ?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
			<td class="label-formulir">Jumlah Buku</td>
			<td class="isian-formulir"><input class="isian-formulir isian-formulir-border" value="<?php echo $r_tampil_buku['jumlahbuku']; ?>" id="jumlahbuku" name="jumlahbuku" type="number"></td>
		</tr>
            <tr>
                <td class="label-formulir"></td>
                <td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" id="tombol-simpan"></td>
            </tr>
        </table> 
    </form> 
</div> 
            