<div id="label-page"><h3>Transaksi Pengembalian</h3></div>
<div id="content">
	<!-- <p id="tombol-tambah-container"><a href="index.php?p=transaksi-peminjaman-input" class="tombol">Transaksi Baru</a></p> -->
	<a target="_blank" href="eksporKembali_pdf.php"><img src="https://objectstorage.us-ashburn-1.oraclecloud.com/n/idqunajpebii/b/UtsSuwanto/o/pdf.jpg" height="50px" height="50px"></a>
    <a target="_blank" href="eksporKembali_excel.php"><img src="https://objectstorage.us-ashburn-1.oraclecloud.com/n/idqunajpebii/b/UtsSuwanto/o/excel.png" height="50px" height="50px"></a>
	<table id="tabel-tampil">
		<tr>
            <th id="label-tampil-no">No</th> 
            <th>ID Transaksi</th> 
            <th>ID Anggota</th> 
            <th>Nama</th> 
            <th>ID Buku</th> 
            <th>Judul Buku</th> 
            <th>Tanggal Pinjam</th> 
            <th>Tanggal Kembali</th>
            <th id="label-opsi2">Opsi</th>
		</tr>
		<?php
    
		$nomor = 0; 
        $q_transaksi=mysqli_query($db,
            "SELECT tbtransaksi.*,tbanggota.*,tbbuku.*
            FROM tbtransaksi,tbanggota,tbbuku
            WHERE tbtransaksi.idanggota=tbanggota.idanggota
            AND tbtransaksi.idbuku=tbbuku.idbuku
            ORDER BY tbtransaksi.idtransaksi"
        ); 
		// $nomor=1;
		while($r_transaksi=mysqli_fetch_array($q_transaksi)){
        $nomor++;
		?>
		<tr>
			<td><?php echo $nomor ?></td>
			<td><?php echo $r_transaksi['idtransaksi']; ?></td>
			<td><?php echo $r_transaksi['idanggota']; ?></td>
			<td><?php echo $r_transaksi['nama']; ?></td>
			<td><?php echo $r_transaksi['idbuku']; ?></td>
			<td><?php echo $r_transaksi['judulbuku']; ?></td>
			<td><?php echo $r_transaksi['tglpinjam']; ?></td>
            <td><?php echo $r_transaksi['tglkembali']; ?></td>
			<td>
            <div class="tombol-opsi-container"><a href="proses/kembali-hapus.php?id=<?php echo $r_transaksi['idtransaksi'];?>" 
            onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="tombol">Hapus</a></div> 
			</td>
		</tr>
		<?php } ?>
	</table>
</div>