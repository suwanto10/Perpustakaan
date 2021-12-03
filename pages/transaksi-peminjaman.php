<div id="label-page"><h3>Transaksi Peminjaman</h3></div>
<div id="content">
	<a id="tombol-tambah-container" href="index.php?p=transaksi-peminjaman-input" class="tombol">Transaksi Baru</a>
	<a target="_blank" href="eksporPinjam_pdf.php"><img src="https://objectstorage.us-ashburn-1.oraclecloud.com/n/idqunajpebii/b/UtsSuwanto/o/pdf.jpg" height="50px" height="50px"></a>
    <a target="_blank" href="eksporPinjam_excel.php"><img src="https://objectstorage.us-ashburn-1.oraclecloud.com/n/idqunajpebii/b/UtsSuwanto/o/excel.png" height="50px" height="50px"></a>
	<br><br>
	<br><br>
	<table id="tabel-tampil">
		<tr>
			<th id="label-tampil-no">No</td>
			<th>ID Transaksi</th>
			<th>ID Anggota</th>
			<th>Nama</th>
			<th>ID Buku</th>
			<th>Judul Buku</th>
			<th>Tanggal Pinjam</th>
			<th id="label-opsi3">Opsi</th>
		</tr>
		<?php
        $batas = 5;
        extract($_GET); 
        if(empty($hal)) { 
            $posisi = 0; 
            $hal = 1; 
            $nomor = 1; 
        }else { 
            $posisi = ($hal - 1) * $batas; 
            $nomor = $posisi+1; 
        }

        if($_SERVER['REQUEST_METHOD'] == "POST") { 
            $pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian'])); 
            if($pencarian != "") { 
                $sql = "SELECT * FROM tbtransaksi WHERE idanggota LIKE '%$pencarian%' 
                        OR idbuku LIKE '%$pencarian%' 
                        OR tglpinjam LIKE '%$pencarian%'"; 

                $query = $sql; 
                $queryJml = $sql; 

            } else { 
                $query = "SELECT * FROM tbtransaksi LIMIT $posisi, $batas"; 
                $queryJml = "SELECT * FROM tbtransaksi"; 
                $no = $posisi * 1; 
            }
        }
        else { 
            $query = "SELECT * FROM tbtransaksi LIMIT $posisi, $batas"; 
            $queryJml = "SELECT * FROM tbtransaksi"; 
            $no = $posisi * 1; 
        }
        // echo $query;
        // die();
    
		$q_transaksi=mysqli_query($db,
			"SELECT tbtransaksi.*,tbanggota.*,tbbuku.*
			FROM tbtransaksi,tbanggota,tbbuku
			WHERE tbtransaksi.idanggota=tbanggota.idanggota
			AND tbtransaksi.idbuku=tbbuku.idbuku
			AND tbtransaksi.tglkembali='0000-00-00'
			ORDER BY tbtransaksi.idtransaksi"
		);
		$nomor=1;
		while($r_transaksi=mysqli_fetch_array($q_transaksi)){
		?>
		<tr>
			<td><?php echo $nomor++; ?></td>
			<td><?php echo $r_transaksi['idtransaksi']; ?></td>
			<td><?php echo $r_transaksi['idanggota']; ?></td>
			<td><?php echo $r_transaksi['nama']; ?></td>
			<td><?php echo $r_transaksi['idbuku']; ?></td>
			<td><?php echo $r_transaksi['judulbuku']; ?></td>
			<td><?php echo $r_transaksi['tglpinjam']; ?></td>
			<td>
				<div class="tombol-opsi-container"><a href="nota-peminjaman.php?&id=<?php echo $r_transaksi['idtransaksi'];?>" target="_blank" class="tombol">Cetak Nota</a></div>
				<div class="tombol-opsi-container"><a href="proses/pengembalian-proses.php?&id=<?php echo $r_transaksi['idtransaksi'];?>" class="tombol">Pengembalian</a></div>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>