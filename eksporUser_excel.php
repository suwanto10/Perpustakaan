<?php 
    require ("vendor/autoload.php");    // load file autoload.php dari composer
    require ("koneksi.php");            // load konfigurasi untuk koneksi ke DB

    use PhpOffice\PhpSpreadsheet\Spreadsheet;   // panggil referensi namespace dari library Spreadsheet
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $spreadsheet = new Spreadsheet();                          // instansiasi class Spreadsheet
    $spreadsheet->setActiveSheetIndex(0)                       // set aktif sheet pada excel
    ->setCellValue('A1', 'Data User Perpustakaan Umum')     // isi data excel sesuai baris dan kolom
    ->setCellValue('A3', 'No')
    ->setCellValue('B3', 'ID User')
    ->setCellValue('C3', 'Nama Lengkap')
    ->setCellValue('D3', 'Alamat');

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

    $query = "SELECT * FROM tbuser ORDER BY iduser"; 
    $q_tampil_user = mysqli_query($db, $query); 
    $idx = 1;

    if(mysqli_num_rows($q_tampil_user) > 0) { 
        while($r_tampil_user=mysqli_fetch_array($q_tampil_user)) { 

            $sheet->setCellValue('A'.$index, $idx);
            $sheet->setCellValue('B'.$index, $r_tampil_user['iduser']);
            $sheet->setCellValue('C'.$index, $r_tampil_user['nama']);
            $sheet->setCellValue('D'.$index, $r_tampil_user['alamat']);

            $index++;
            $idx++;
        } // end looping 
    }

    $sheet->setTitle('Data User');
    $spreadsheet->setActiveSheetIndex(0);

    $filename = 'Data-User-Perpus.xlsx';

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