<?php 
    require("vendor/autoload.php");         //load file autoload.php dari composer
    require("koneksi.php");                 //load konfigurasi untuk koneksi ke DB

    use Dompdf\Dompdf;                      //panggil referensi namespace dari library Dompdf
    use Dompdf\Options;

    // $menu = [
    //     ['nama' => 'Jeruk', 'jenis' => 'Buah', 'harga' => 14000],
    //     ['nama' => 'Pisang', 'jenis' => 'Buah', 'harga' => 12000],
    //     ['nama' => 'Nasi Goreng', 'jenis' => 'Manakan', 'harga' => 12000],
    //     ['nama' => 'Mie Goreng', 'jenis' => 'Makanan', 'harga' => 10000],
    //     ['nama' => 'Jus Jambu', 'jenis' => 'Minuman', 'harga' => 6000],
    //     ['nama' => 'Air Mineral', 'jenis' => 'Minuman', 'harga' => 3000],
    //     ['nama' => 'Wortel', 'jenis' => 'Sayur', 'harga' => 9000],
    //     ['nama' => 'Tomat', 'jenis' => 'Sayur', 'harga' => 5000],
    // ];

    $html = '<h3 align="center">Transaksi Peminjaman Perpustakaan</h3>';
    $html .= '<table width="100%" border="1" cellspacing="0" cellpadding="2">
            <thead> 
                <tr> 
                    <th id="label-tampil-no">No</th> 
                    <th>ID Transaksi</th>
                    <th>ID Anggota</th>
                    <th>Nama</th>
                    <th>ID Buku</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th> 
                </tr> 
            </thead> 
            <tbody> ';

    $nomor = 1; 
    $q_transaksi=mysqli_query($db,
        "SELECT tbtransaksi.*,tbanggota.*,tbbuku.*
		FROM tbtransaksi,tbanggota,tbbuku
		WHERE tbtransaksi.idanggota=tbanggota.idanggota
		AND tbtransaksi.idbuku=tbbuku.idbuku
		AND tbtransaksi.tglkembali='0000-00-00'
		ORDER BY tbtransaksi.idtransaksi"
    ); 

    while($r_transaksi=mysqli_fetch_array($q_transaksi)){
        $html .= '<tr>
        <td>'. $nomor.'</td> 
        <td>'. $r_transaksi['idtransaksi'].'</td> 
        <td>'. $r_transaksi['idanggota'].'</td> 
        <td>'. $r_transaksi['nama'].'</td>
        <td>'. $r_transaksi['idbuku'].'</td> 
        <td>'. $r_transaksi['judulbuku'].'</td>
        <td>'. $r_transaksi['tglpinjam'].'</td> 
    </tr> ';
    $nomor++; 
    }

    $html .= '</tbody></html>';

    $dompdf = new Dompdf();                         //instansiasi class Dompdf
    $dompdf->set_option('isRemoteEnabled', TRUE);
    $dompdf->load_html($html);                      //isi konten (format HTML) untuk dokumen pdf
    $dompdf->setPaper('a4', 'landscape');           //set ukuran dan orientasi dokumen pdf
    $dompdf->render();                              //render kode HTML menjadi pdf
    $dompdf->stream();                              //stream pdf ke browser
?> 
 


