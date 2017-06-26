<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus 
if ($module=='pemohon' AND $act=='hapus'){
  mysql_query("DELETE FROM pemohon WHERE id_pemohon='$_GET[id]'");
  header('location:../../index.php?module='.$module);
}

// Input 
elseif ($module=='pemohon' AND $act=='input'){
$no_ktp=$_POST[no_ktp];
$nama=$_POST[nama];
$alamat=$_POST[alamat];
$istri_suami=$_POST[istri_suami];
$jlh_tanggungan=$_POST[jlh_tanggungan];
$pekerjaan=$_POST[pekerjaan];
mysql_query("INSERT INTO pemohon(
			      no_ktp,nama,alamat,istri_suami,jlh_tanggungan,pekerjaan) 
	        VALUES(
				'$no_ktp','$nama','$alamat','$istri_suami','$jlh_tanggungan','$pekerjaan')");
  header('location:../../index.php?module='.$module);
}

// Update 
elseif ($module=='pemohon' AND $act=='update'){
$no_ktp=$_POST[no_ktp];
$nama=$_POST[nama];
$alamat=$_POST[alamat];
$istri_suami=$_POST[istri_suami];
$jlh_tanggungan=$_POST[jlh_tanggungan];
$pekerjaan=$_POST[pekerjaan];
  mysql_query("UPDATE pemohon SET
					no_ktp	= '$no_ktp',
					nama   = '$nama',
					alamat   = '$alamat',
					istri_suami   = '$istri_suami',
					jlh_tanggungan   = '$jlh_tanggungan',
					pekerjaan		=  '$pekerjaan',
                WHERE id_pemohon       = '$_POST[id]'");
  header('location:../../index.php?module='.$module);
 }
 
?>