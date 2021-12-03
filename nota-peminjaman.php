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

    $html = '<h3 align="center">Nota Peminjaman Buku</h3>';
    $html .= '<table width="100%" border="1" cellspacing="0" cellpadding="2">
            <thead> 
                <tr> 
                    <th id="label-tampil-no">No</th> 
                    <th>ID Transaksi</th> 
                    <th>Tanggal Pinjam</th> 
                    <th>ID Anggota</th> 
                    <th>ID Buku</th> 
                    <th>Nama</th> 
                    <th>Judul Buku</th> 
                </tr> 
            </thead> 
            <tbody> ';

    $id_transaksi=$_GET['id'];
    $nomor = 1; 
    $q_nota_peminjaman=mysqli_query($db,
        "SELECT tbtransaksi.*,tbanggota.*,tbbuku.*
        FROM tbtransaksi,tbanggota,tbbuku
        WHERE tbtransaksi.idanggota=tbanggota.idanggota
        AND tbtransaksi.idbuku=tbbuku.idbuku
        AND tbtransaksi.idtransaksi='$id_transaksi'"
    ); 

    // echo $query;
    // die();
    while($r_nota_peminjaman=mysqli_fetch_array($q_nota_peminjaman)){
        $html .= '<tr>
        <td>'. $nomor.'</td> 
        <td>'. $r_nota_peminjaman['idtransaksi'].'</td> 
        <td>'. $r_nota_peminjaman['tglpinjam'].'</td> 
        <td>'. $r_nota_peminjaman['idanggota'].'</td> 
        <td>'. $r_nota_peminjaman['idbuku'].'</td> 
        <td>'. $r_nota_peminjaman['nama'].'</td>
        <td>'. $r_nota_peminjaman['judulbuku'].'</td>
    </tr> ';
    $nomor++; 
    }
    $html .= '</tbody></html>';

    $dompdf = new Dompdf();                         //instansiasi class Dompdf
    $dompdf->set_option('isRemoteEnabled', TRUE);
    $dompdf->load_html($html);                      //isi konten (format HTML) untuk dokumen pdf
    $dompdf->setPaper('a4', 'landscape');           //set ukuran dan orientasi dokumen pdf
    $dompdf->render();                              //render kode HTML menjadi pdf
    $dompdf->stream();  
                             
?> 
 


