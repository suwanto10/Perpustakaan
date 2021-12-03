<?php 
    require ("vendor/autoload.php");    // load file autoload.php dari composer
    require ("koneksi.php");            // load konfigurasi untuk koneksi ke DB

    use PhpOffice\PhpSpreadsheet\Spreadsheet;   // panggil referensi namespace dari library Spreadsheet
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $spreadsheet = new Spreadsheet();                          // instansiasi class Spreadsheet
    $spreadsheet->setActiveSheetIndex(0)                       // set aktif sheet pada excel
    ->setCellValue('A1', 'Data Transaksi Peminjaman Perpustakaan Umum')     // isi data excel sesuai baris dan kolom
    ->setCellValue('A3', 'No')
    ->setCellValue('B3', 'ID Transaksi')
    ->setCellValue('C3', 'ID Anggota')
    ->setCellValue('D3', 'Nama')
    ->setCellValue('E3', 'ID Buku')
    ->setCellValue('F3', 'Judul Buku')
    ->setCellValue('G3', 'Tanggal Pinjam');

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

    $q_transaksi=mysqli_query($db,
			"SELECT tbtransaksi.*,tbanggota.*,tbbuku.*
			FROM tbtransaksi,tbanggota,tbbuku
			WHERE tbtransaksi.idanggota=tbanggota.idanggota
			AND tbtransaksi.idbuku=tbbuku.idbuku
			AND tbtransaksi.tglkembali='0000-00-00'
			ORDER BY tbtransaksi.idtransaksi"
	);
    $idx = 1;
    
    while($r_transaksi=mysqli_fetch_array($q_transaksi)){

            $sheet->setCellValue('A'.$index, $idx);
            $sheet->setCellValue('B'.$index, $r_transaksi['idtransaksi']);
            $sheet->setCellValue('C'.$index, $r_transaksi['idanggota']);
            $sheet->setCellValue('D'.$index, $r_transaksi['nama']);
            $sheet->setCellValue('E'.$index, $r_transaksi['idbuku']);
            $sheet->setCellValue('F'.$index, $r_transaksi['judulbuku']);
            $sheet->setCellValue('G'.$index, $r_transaksi['tglpinjam']);

            $index++;
            $idx++;
    } 
    

    $sheet->setTitle('Data Transaksi Peminjaman');
    $spreadsheet->setActiveSheetIndex(0);

    $filename = 'Data-Peminjaman-Perpus.xlsx';

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