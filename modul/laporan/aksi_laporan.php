<?php
include "../../pdf/fpdf.php";
include "../../config/koneksi.php";
require('../../pdf/mc_table.php');

$module=$_GET[module];
$act=$_GET[act];

if ($module=='laporan' AND $act=='cetak'){

$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->setFont('Arial','B',14);
$pdf->setXY(10,8); $pdf->cell(30,6,'Laporan Hasil Penilaian');
$pdf->setXY(10,16); $pdf->cell(30,6,'Sistem Pendukung Keputusan Penentuan Pemberian Kredit');

$pdf->setFont('Arial','B',10);

$y_initial = 35;
$y_axis1 = 29;

$pdf->setFont('Arial','',10);

$pdf->setFillColor(233,233,233);
$pdf->setY($y_axis1);
$pdf->setX(10);

$pdf->SetWidths(array(8,40,40,20,30,20,30));
$pdf->Row(array("NO","NAMA KK","ALAMAT","RT/RW","DESA/KEL","NILAI","REKOMENDASI"));

$y = $y_initial + $row;

$sql = mysql_query("SELECT * FROM nilai_hasil ORDER BY nilai desc");
$no = 0;
$row = 8;
while ($data = mysql_fetch_array($sql))
{
	$no++;
	$edit2=mysql_query("SELECT * FROM kk WHERE id_kk='$data[id_kk]'");
    $r2=mysql_fetch_array($edit2);
	$pdf->Row(array($no,$r2[nama_kk],$r2[alamat],$r2[rt_rw],$r2[desa_kel],$data[nilai],$no));
	$y = $y + $row;
}

$pdf->Output();

header('location:../../index.php?module='.$module);
}
?>