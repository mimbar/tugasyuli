<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Input 
if ($module=='angsuran' AND $act=='bayar'){

  $kode_pinjaman=$_POST['kode_pinjaman'];
  $angsuran=$_POST['angsuran'];
  $tgl_angsuran=$_POST['tgl_angsuran'];

  $sql = "SELECT COUNT(kode_pinjaman) as hitung from tb_angsuran where kode_pinjaman=$kode_pinjaman";
  $data = mysql_query($sql);
  while ($row = mysql_fetch_assoc($data)) {
    $hitung = $row['hitung'];
  }

  $sql = "SELECT lama_pinjaman from tb_pinjaman where kode_pinjaman=$kode_pinjaman";
  $data = mysql_query($sql);
  while ($row = mysql_fetch_assoc($data)) {
    $lama_pinjaman = $row['lama_pinjaman'];
  }

  if ($lama_pinjaman > $hitung) {
    if ($lama_pinjaman-1 == $hitung) {
      $insert = mysql_query("INSERT INTO tb_angsuran(
        kode_pinjaman,angsuran,tgl_angsuran) 
        VALUES(
        '$kode_pinjaman','$angsuran','$tgl_angsuran')");

      mysql_query("UPDATE `tb_pinjaman` SET `danabekucair`='1' WHERE (`kode_pinjaman`='$kode_pinjaman')");
      header('location:../../index.php?module='.$module);



    } else {
     $insert = mysql_query("INSERT INTO tb_angsuran(
      kode_pinjaman,angsuran,tgl_angsuran) 
      VALUES(
      '$kode_pinjaman','$angsuran','$tgl_angsuran')");
     header('location:../../index.php?module='.$module);
   }


 }else{
  header('location:../../index.php?module='.$module);
}

header('location:../../index.php?module='.$module);
}



?>