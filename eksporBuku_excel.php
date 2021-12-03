<?php 
    require ("vendor/autoload.php");    // load file autoload.php dari composer
    require ("koneksi.php");            // load konfigurasi untuk koneksi ke DB

    use PhpOffice\PhpSpreadsheet\Spreadsheet;   // panggil referensi namespace dari library Spreadsheet
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $spreadsheet = new Spreadsheet();                          // instansiasi class Spreadsheet
    $spreadsheet->setActiveSheetIndex(0)                       // set aktif sheet pada excel
    ->setCellValue('A1', 'Data Buku Perpustakaan Umum')     // isi data excel sesuai baris dan kolom
    ->setCellValue('A3', 'No')
    ->setCellValue('B3', 'ID Buku')
    ->setCellValue('C3', 'Judul Buku')
    ->setCellValue('D3', 'Foto')
    ->setCellValue('E3', 'Kategori')
    ->setCellValue('F3', 'Pengarang')
    ->setCellValue('G3', 'Penerbit')
    ->setCellValue('H3', 'Jumlah Buku');

    $sheet = $spreadsheet->getActiveSheet();

    $index = 4;     // baris mulai isi data dinamis, mulai baris 4

    // if (count ($menu) > 0) {

    //     foreach ($menu as $idx => $val) {
    //         $idx++;

    //         $sheet->setCellValue('A'.$index, $idx);
    //         $sheet->setCellValue('B'.$index, $val['nama']);
    //         $sheet->setCellValue('C'.$index, $val['jenis']);
    //         $sheet->setCellValue('D'.$index, $val['harga']);

    //         $index++;
    //     }
    // }

    $query = "SELECT * FROM tbbuku ORDER BY idbuku DESC"; 
    $q_tampil_buku = mysqli_query($db, $query); 
    $idx = 0;

    if(mysqli_num_rows($q_tampil_buku) > 0) { 
        while($r_tampil_buku=mysqli_fetch_array($q_tampil_buku)) { 
            $idx++;
            if(empty($r_tampil_buku['foto']) or ($r_tampil_buku['foto'] == '-')) {
                $foto = "admin-no-photo.jpg"; 
            } else { 
                $foto = $r_tampil_buku['foto']; 
            }

            $sheet->setCellValue('A'.$index, $idx);
            $sheet->setCellValue('B'.$index, $r_tampil_buku['idbuku']);
            $sheet->setCellValue('C'.$index, $r_tampil_buku['judulbuku']);
            $sheet->setCellValue('D'.$index, $foto);
            $sheet->setCellValue('E'.$index, $r_tampil_buku['kategori']);
            $sheet->setCellValue('F'.$index, $r_tampil_buku['pengarang']);
            $sheet->setCellValue('G'.$index, $r_tampil_buku['penerbit']);
            $sheet->setCellValue('H'.$index, $r_tampil_buku['jumlahbuku']);

            $index++;
        } // end looping 
    }

    $sheet->setTitle('Data Buku');
    $spreadsheet->setActiveSheetIndex(0);

    $filename = 'Data-Buku-Perpus.xlsx';

    ob_end_clean();     // untuk mengatasi excel cannot open the file format or file extension is not valid

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit();
?>