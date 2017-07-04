<?php

include "config/koneksi.php";
include "pdf/mpdf.php";
$sql="SELECT id_pemohon, nama from pemohon";
$pemohon = mysql_query($sql);
$pemohon2 = mysql_query($sql);

?>
<h6 class='red'>Laporan Statistik</h6>

<form name=text_form method=POST action='report.php?modul=statistik' onsubmit='return Blank_TextField_Validator()'>
	<table>
		<tr><td>Cetak</td>   <td><input type=submit name=submit value='Cetak' >
	</tr>
</table>
</form>

<h6 class='red'>Laporan Hasil Penilaian</h6>

<form name=text_form method=POST action='report.php?modul=penilaian' onsubmit='return Blank_TextField_Validator()'>
	<table>
		<tr><td>Cetak</td>   <td><input type=submit name=submit value='Cetak' >
	</tr>
</table>
</form>

<h6 class='red'>Laporan Pinjaman</h6>

<form name=text_form method=POST action='report.php?modul=pinjaman' onsubmit='return Blank_TextField_Validator()'>
	<table>
		<tr><td>Cetak</td>   <td> :<input type=submit name=submit value='Cetak' > </tr>
	</table>
	
</form>
