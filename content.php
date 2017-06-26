<?php
include "config/koneksi.php";
$module = $_GET['module'];
if ($module == ""){
if (!empty($_SESSION['username']) && !empty($_SESSION['password'])){
echo '
<p>Persyaratan Untuk Pengajuan Kredit :
<li>Formulir Permohonan Kredit</li>
<li>Photocopy Kartu Keluarga (KK)</li>
<li>Photocopy Kartu Tanda Penduduk (KTP)</li>
<li>Photo ukuran 3x4 sebanyak 2 lembar </li>
';
}
else{
include "formlogin.php";
}
}
elseif ($module == "kriteria"){
	include "modul/kriteria/kriteria.php";
}
elseif ($module == "pemohon"){
	include "modul/pemohon/pemohon.php";
}
elseif ($module == "penilaian"){
	include "modul/penilaian/penilaian.php";
}
elseif ($module == "penilaianp"){
	include "modul/penilaianP/penilaianP.php";
}
elseif ($module == "rekomendasi"){
	include "modul/rekomendasi/rekomendasi.php";
}
elseif ($module == "password"){
	include "modul/password/password.php";
}
elseif ($module == "laporan"){
	include "modul/laporan/laporan.php";
}
elseif ($module == "pinjaman"){
  include "modul/pinjaman/pinjaman.php";
}
elseif ($module == "angsuran"){
  include "modul/angsuran/angsuran.php";
}
?>