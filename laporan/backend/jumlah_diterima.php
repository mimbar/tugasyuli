<?php
error_reporting(0);
session_start();

require_once ( '../../config/koneksi.php' );
require_once ( '../../ahp.php' );
require_once('../../modul/rekomendasi/fungsi.php');


$nilaiakhir = 0;
$diterima = 0;
$ditolak = 0;

$labels = [];
$datas = [];

$nilaiakhir = 0;
for($i=0;$i<count($kk);$i++){
	for($ii=0;$ii<count($kriteria);$ii++){
		$nilaiakhir = $nilaiakhir + $eigen_kk[$ii][$i];
	}

	if ($nilaiakhir > 1) {$diterima = $diterima+1;} else {$ditolak = $ditolak+1;}
	$nilaiakhir=0;
}

$datas = [
'labels' => ['Diterima', 'Tidak Diterima'],
'datas' => [$diterima, $ditolak]
];

echo json_encode($datas);
?>
