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

    $html = '<h3 align="center">Data Buku Perpustakaan</h3>';
    $html .= '<table width="100%" border="1" cellspacing="0" cellpadding="2">
            <thead> 
                <tr> 
                    <th id="label-tampil-no">No</th> 
                    <th>ID Buku</th>
                    <th>Judul Buku</th>
                    <th>Foto</th>
                    <th>Kategori</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Jumlah Buku</th> 
                </tr> 
            </thead> 
            <tbody> ';

    $nomor = 1; 
    $query = "SELECT * FROM tbbuku ORDER BY idbuku DESC"; 
    $q_tampil_buku = mysqli_query($db, $query); 

    if(mysqli_num_rows($q_tampil_buku) > 0) { 
        while($r_tampil_buku=mysqli_fetch_array($q_tampil_buku)) { 
            if(empty($r_tampil_buku['foto']) or ($r_tampil_buku['foto'] == '-')) {
                $foto = "admin-no-photo.jpg"; 
            } else { 
                $foto = $r_tampil_buku['foto']; 
            }

    $html .= '<tr>
                <td>'. $nomor.'</td> 
                <td>'. $r_tampil_buku['idbuku'].'</td> 
                <td>'. $r_tampil_buku['judulbuku'].'</td> 
                <td><img src="https://objectstorage.ap-osaka-1.oraclecloud.com/n/ax9vujnwdmvy/b/Ujian_Tengah_Semester/o/images%2F'.$foto.'" width="70px" height="70px"></td>
                <td>'. $r_tampil_buku['kategori'].'</td> 
                <td>'. $r_tampil_buku['pengarang'].'</td> 
                <td>'. $r_tampil_buku['penerbit'].'</td> 
                <td>'. $r_tampil_buku['jumlahbuku'].'</td> 
            </tr> ';
            $nomor++; 
        } // end looping 
    } else {
        $html .= '<tr><td colspan="4" align="center">Tidak Ada Data</td></tr>';
    }     

    $html .= '</tbody></html>';

    $dompdf = new Dompdf();                         //instansiasi class Dompdf
    $dompdf->set_option('isRemoteEnabled', TRUE);
    $dompdf->load_html($html);                      //isi konten (format HTML) untuk dokumen pdf
    $dompdf->setPaper('a4', 'landscape');           //set ukuran dan orientasi dokumen pdf
    $dompdf->render();                              //render kode HTML menjadi pdf
    $dompdf->stream();                              //stream pdf ke browser
?> 
 


