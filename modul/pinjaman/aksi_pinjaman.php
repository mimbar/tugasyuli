<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus 
if ($module=='pinjaman' AND $act=='hapus'){
  mysql_query("DELETE FROM pemohon WHERE id_pemohon='$_GET[id]'");
  header('location:../../index.php?module='.$module);
}

// Input 
elseif ($module=='pinjaman' AND $act=='input'){

 $id_pemohon=$_POST['id_pemohon'];
 $besar_pinjaman=$_POST['besar_pinjaman'];
 $lama_pinjaman=$_POST['lama_pinjaman'];
 $tgl_pinjaman = date('Y-m-d');
 $nilai_bunga = $besar_pinjaman * (18/100);
 $total_pinjaman = $besar_pinjaman + $nilai_bunga;
 $angsuran = $total_pinjaman / $lama_pinjaman;
 $ratusan = substr($angsuran, -2);
 if($ratusan > 0){
  $tambahkeun = 100 - $ratusan;
  $akhir = round($angsuran + $tambahkeun);
}else{
 $akhir = $angsuran;
}


$danabeku = $besar_pinjaman * (2.5/100);

echo $akhir;
if ($besar_pinjaman >= 1000000) {
  mysql_query("INSERT INTO tb_pinjaman(
    id_pemohon,besar_pinjaman,bunga,lama_pinjaman,tgl_pinjaman,nilai_bunga,total_pinjaman,angsuran,danabeku,danabekucair) 
    VALUES(
    '$id_pemohon','$besar_pinjaman',18,'$lama_pinjaman','$tgl_pinjaman','$nilai_bunga','$total_pinjaman','$akhir','$danabeku',0)");
  header('location:../../index.php?module='.$module);
} else {
  echo "string";
}


}

?>