<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus kriteria
if ($module=='kriteria' AND $act=='hapus'){
  mysql_query("DELETE FROM kriteria WHERE id_kriteria='$_GET[id]'");
  header('location:../../index.php?module='.$module);
}

// Input kriteria
elseif ($module=='kriteria' AND $act=='input'){
$nama_kriteria=$_POST[nama_kriteria];
mysql_query("INSERT INTO kriteria(
			      nama_kriteria) 
	        VALUES(
				'$nama_kriteria')");
  header('location:../../index.php?module='.$module);
}

// Update kriteria
elseif ($module=='kriteria' AND $act=='update'){
$nama_kriteria=$_POST[nama_kriteria];
  mysql_query("UPDATE kriteria SET
					nama_kriteria   = '$nama_kriteria'
                WHERE id_kriteria       = '$_POST[id]'");
  header('location:../../index.php?module='.$module);
 }
 
?>