<?php
error_reporting(0);
session_start();

require_once ( '../../config/koneksi.php' );
$sql = "select * from v_tb_jumlahangsuran";
$query = mysql_query($sql);
$labels = [];
$datas = [];

while($data = mysql_fetch_array($query)){
	array_push($labels, $data['bulan']);
	array_push($datas, $data['totalangsuran']);
}

$json = [
'labels' => $labels,
'datas' => $datas
];

echo json_encode($json);
?>
