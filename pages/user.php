<div id="label-page"><h3>Tampil Data User</h3></div>
<div id="content">
	<a id="tombol-tambah-container" href="index.php?p=user-input" class="tombol">Tambah Data</a>
	<a target="_blank" href="eksporUser_pdf.php"><img src="https://objectstorage.us-ashburn-1.oraclecloud.com/n/idqunajpebii/b/UtsSuwanto/o/pdf.jpg" height="50px" height="50px"></a>
    <a target="_blank" href="eksporUser_excel.php"><img src="https://objectstorage.us-ashburn-1.oraclecloud.com/n/idqunajpebii/b/UtsSuwanto/o/excel.png" height="50px" height="50px"></a>
	<br><br>
	<br><br>
	<table id="tabel-tampil">
		<tr>
			<th id="label-tampil-no">No</td>
			<th>ID User</th>
			<th>Nama Lengkap</th>
			<th>Alamat</th>
			<th id="label-opsi">Opsi</th>
		</tr>
		<?php
		$q_tampil_user=mysqli_query($db,"SELECT * FROM tbuser ORDER BY iduser")or die(mysqli_error());
		$nomor=1;
		while($r_tampil_user=mysqli_fetch_array($q_tampil_user)){
		?>
		<tr>
			<td><?php echo $nomor++; ?></td>
			<td><?php echo $r_tampil_user['iduser']; ?></td>
			<td><?php echo $r_tampil_user['nama']; ?></td>
			<td><?php echo $r_tampil_user['alamat']; ?></td>
			<td>
				<!-- <div class="tombol-opsi-container"><a href="cetak/cetak-kartu-identitas-user.php?id=<?php echo $r_tampil_user['iduser']; ?>" target="_blank" class="tombol">Cetak Kartu</a></div> -->
				<div class="tombol-opsi-container"><a href="index.php?p=user-edit&id=<?php echo $r_tampil_user['iduser'];?>" class="tombol">Edit</a></div>
				<div class="tombol-opsi-container"><a href="proses/user-hapus.php?id=<?php echo $r_tampil_user['iduser']; ?>" class="tombol">Hapus</a></div>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>