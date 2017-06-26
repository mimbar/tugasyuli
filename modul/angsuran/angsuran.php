<?php
include "config/fungsi_alert.php";
$aksi="modul/angsuran/aksi_pemohon.php";
switch($_GET['act']){
	
  default:
  $offset=$_GET['offset'];

  $limit = 10;
  if (empty ($offset)) {
    $offset = 0;
  }
  $tampil=mysql_query("SELECT * FROM pemohon ORDER BY id_pemohon");
  $baris=mysql_num_rows($tampil);
 

  if ($_POST['Go']){
    
   $numrows = mysql_num_rows(mysql_query("SELECT * FROM v_tb_pinjaman where danabekucair = 0 and nama like '%$katakunci%'"));
   if ($numrows > 0){
    echo "<p>Hasil Pencarian: <b>Ditemukan</b></p>";
    $i = 1;
    echo" <table cellpadding='0' cellspacing='0'>
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal Pinjam</th>
        <th>Nama Pemohon</th>
        <th>Jumlah Pinjaman</th>
        <th>Bunga</th>
        <th>Total Pinjaman</th>
        <th>Lama Pinjaman</th>
        <th>Angsuran</th>
        <th>Aksi</th>th>
        <th>Istri/Suami</th>
        <th>Jumlah Tanggungan</th>
      </tr>
    </thead>
    <tbody>"; 
     $hasil = mysql_query("SELECT * FROM v_tb_pinjaman where danabekucair = 0 and nama like '%$_POST[keyword]%'");
     $no = 1;
     $counter = 1;
     while ($r=mysql_fetch_array($hasil)){
       if ($counter % 2 == 0) $warna = "light";
       else $warna = "dark";
       echo "<tr class='".$warna."'>
       <td align=center>$no</td>
       <td>$r[tgl_pinjaman]</td>
       <td>$r[nama]</td>
       <td>$besar_pinjaman</td>
       <td>$nilai_bunga</td>
       <td>$total_pinjaman</td>
       <td>$lama_pinjaman</td>
       <td>$angsuran</td>
       <td align=center>
        <a href=?module=angsuran&act=bayar&kode_pinjaman=$r[kode_pinjaman]>Angsur</a> &nbsp;
		<a href=report.php?modul=history&id=$r[kode_pinjaman]>History</a> &nbsp;
		<a href=report.php?modul=kartu&id=$r[kode_pinjaman]>Kartu Angsuran</a> &nbsp;
        
      </td></tr>";
      $no++;
      $counter++;
    }
    echo "</tbody></table>";
  }
  
}else{
  
  if($baris>0){
   echo"<p><table cellpadding='0' cellspacing='0'>
   <thead>
    <tr>
      <th>No</th>
      <th>Tanggal Pinjam</th>
      <th>Nama Pemohon</th>
      <th>Jumlah Pinjaman</th>
      <th>Bunga</th>
      <th>Total Pinjaman</th>
      <th>Lama Pinjaman</th>
      <th>Angsuran</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    "; 
    $hasil = mysql_query("SELECT * FROM v_tb_pinjaman where danabekucair = 0 ORDER BY kode_pinjaman limit $offset,$limit");
    $no = 1;
    $no = 1 + $offset;
    $counter = 1;
    while ($r=mysql_fetch_array($hasil)){
     if ($counter % 2 == 0) $warna = "light";
     else $warna = "dark";
     $besar_pinjaman = number_format($r['besar_pinjaman'],0,".",".");
     $nilai_bunga = number_format($r['nilai_bunga'],0,".",".");
     $total_pinjaman = number_format($r['total_pinjaman'],0,".",".");
     $lama_pinjaman = number_format($r['lama_pinjaman'],0,".",".");
     $angsuran = number_format($r['angsuran'],0,".",".");

     echo "<tr class='".$warna."'>
     <td align=center>$no</td>
     <td>$r[tgl_pinjaman]</td>
     <td>$r[nama]</td>
     <td>$besar_pinjaman</td>
     <td>$nilai_bunga</td>
     <td>$total_pinjaman</td>
     <td>$lama_pinjaman</td>
     <td>$angsuran</td>
     <td align=center>
       <a href=?module=angsuran&act=bayar&kode_pinjaman=$r[kode_pinjaman]>Angsur</a> &nbsp;
    <a href=report.php?modul=kartu&id=$r[kode_pinjaman]>Kartu Angsuran</a> &nbsp;
    </td></tr>";
    $no++;
    $counter++;
  }
  echo "</tbody></table>";
  echo "<div class=paging>";

  if ($offset!=0) {
    $prevoffset = $offset-10;
    echo "<span class=prevnext> <a href=index.php?module=pemohon&offset=$prevoffset>Back</a></span>";
  }
  else {
		echo "<span class=disabled>Back</span>";//cetak halaman tanpa link
	}
	//hitung jumlah halaman
	$halaman = intval($baris/$limit);//Pembulatan

	if ($baris%$limit){
		$halaman++;
	}
	for($i=1;$i<=$halaman;$i++){
		$newoffset = $limit * ($i-1);
		if($offset!=$newoffset){
			echo "<a href=index.php?module=pemohon&offset=$newoffset>$i</a>";
			//cetak halaman
		}
		else {
			echo "<span class=current>".$i."</span>";//cetak halaman tanpa link
		}
	}

	//cek halaman akhir
	if(!(($offset/$limit)+1==$halaman) && $halaman !=1){

		//jika bukan halaman terakhir maka berikan next
		$newoffset = $offset + $limit;
		echo "<span class=prevnext><a href=index.php?module=pemohon&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
}
}
break;

case "bayar":
require_once "bayar.php";
break;

}
?>
