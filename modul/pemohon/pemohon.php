<script Language="JavaScript">
<!-- 
function Blank_TextField_Validator()
{
if (text_form.nama.value == "")
{
   alert("Nama  tidak boleh kosong !");
   text_form.nama.focus();
   return (false);
}
return (true);
}
function Blank_TextField_Validator_Cari()
{
if (text_form.keyword.value == "")
{
   alert("Isi dulu keyword pencarian !");
   text_form.keyword.focus();
   return (false);
}
return (true);
}
-->
</script>
<?php
include "config/fungsi_alert.php";
$aksi="modul/pemohon/aksi_pemohon.php";
switch($_GET[act]){
	
  default:
  $offset=$_GET['offset'];
	
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM pemohon ORDER BY id_pemohon");
	$baris=mysql_num_rows($tampil);
	echo "<text align=center>";
	echo "<br><form method=POST action='?module=pemohon' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
          <table>
		  <tr><td><h6 class='red'>Cari Data Pemohon</h6></tr></td>
		  <tr><td>Nama Pemohon : <input type=text name='keyword' id='keyword' /> <input type=submit value='   Cari   ' name=Go></td> </tr>
          </table></form>";
		  
	if ($_POST[Go]){
			$numrows = mysql_num_rows(mysql_query("SELECT * FROM pemohon where nama like '%$_POST[keyword]%'"));
			if ($numrows > 0){
				echo "<p>Hasil Pencarian: <b>Ditemukan</b></p>";
				$i = 1;
	echo" <table cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
			  <th>No KTP</th>
              <th>Nama Pemohon</th>
              <th>Alamat</th>
              <th>Istri/Suami</th>
              <th>Jumlah Tanggungan</th>
			  <th>Pekerjaan</th>
            </tr>
          </thead>
		  <tbody>"; 
	$hasil = mysql_query("SELECT * FROM pemohon where nama like '%$_POST[keyword]%'");
	$no = 1;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "light";
	else $warna = "dark";
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
			 <td>$r[no_ktp]</td>
	         <td>$r[nama]</td>
	         <td>$r[alamat]</td>
	         <td>$r[istri_suami]</td>
	         <td>$r[jlh_tanggungan]</td>
			 <<td>$r[pekerjaan]</td>
			 <td align=center><a href=?module=pemohon&act=editkk&id=$r[id_pemohon]>Ubah</a> &nbsp;
	          <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=pemohon&act=hapus&id=$r[id_pemohon]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">Hapus</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
			}
			else{
				echo "<p>Hasil Pencarian: <b>Tidak Ditemukan</b></p>";
			}
		}else{
	 echo "<input type=button name=tambah value='Tambah Data Pemohon' onclick=\"window.location.href='?module=pemohon&act=tambahkk';\"><br>";
	if($baris>0){
	echo"<p><table cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>No KTP</th>
              <th>Nama Pemohon</th>
              <th>Alamat</th>
              <th>Istri/Suami</th>
              <th>Jumlah Tanggungan</th>
			  <th>Pekerjaan</th>
              <th>Aksi</th>
            </tr>
          </thead>
		  <tbody>
		  "; 
	$hasil = mysql_query("SELECT * FROM pemohon ORDER BY id_pemohon limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "light";
	else $warna = "dark";
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
	        <td>$r[no_ktp]</td>
	         <td>$r[nama]</td>
	         <td>$r[alamat]</td>
	         <td>$r[istri_suami]</td>
	         <td>$r[jlh_tanggungan]</td>
			 <td>$r[pekerjaan]</td>
			 <td align=center>
			 <a href=?module=pemohon&act=editkk&id=$r[id_pemohon]>Ubah</a> &nbsp;
	          <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=pemohon&act=hapus&id=$r[id_pemohon]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">Hapus</a>
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
	}else{
	echo "<br><b>Tidak Ada Data Kepala Keluarga !</b>";
	}
	}
    break;
  
  case "tambahkk":
    echo "<h6 class='orange'>Tambah Data Pemohona</h6>
          <form name=text_form method=POST action='$aksi?module=pemohon&act=input' onsubmit='return Blank_TextField_Validator()'>
          <table>
		  <tr><td>No KTP</td>   <td> : <input type=text id='no_ktp' name='no_ktp' size=30></td></tr>
          <tr><td>Nama Pemohon</td>   <td> : <input type=text id='nama' name='nama' size=30></td></tr>
          <tr><td>Alamat</td>   <td> : <input type=text id='alamat' name='alamat' size=30></td></tr>
		  <tr><td>Istri/Suami</td>   <td> : <input type=text id='istri_suami' name='istri_suami' size=30></td></tr>
		  <tr><td>Jumlah Tanggungan</td>   <td> : <input type=text id='jlh_tanggungan' name='jlh_tanggungan' size=30></td></tr>
		  <tr><td> <tr><td>Pekerjaan</td>   <td> : <input type=text id='pekerjaan' name='pekerjaan' size=30></td></tr></td></tr>
		   <tr><td></td><td>
		  <input type=submit name=submit value='Simpan' >
		  <input type=button name=batal value='Batal' onclick=\"window.location.href='?module=pemohon';\">
		  </td></tr>
          </table></form>";
     break;
    
 case "editkk":
    $edit=mysql_query("SELECT * FROM pemohon WHERE id_pemohon='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
    echo "<h6 class='orange'>Edit Data Pemohona</h6>
          <form name=text_form method=POST action='$aksi?module=pemohon&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[id_pemohon]'>
          <table>
		   <tr><td>No KTP</td>   <td> : <input type=text id='no_ktp' name='no_ktp' size=30 value='$r[no_ktp]'></td></tr>
	     <tr><td>Nama Pemohon</td>   <td> : <input type=text id='nama' name='nama' size=30 value='$r[nama]'></td></tr>
          <tr><td>Alamat</td>   <td> : <input type=text id='alamat' name='alamat' size=30 value='$r[alamat]'></td></tr>
		  <tr><td>Istri/Suami</td>   <td> : <input type=text id='istri_suami' name='istri_suami' size=30 value='$r[istri_suami]'></td></tr>
		  <tr><td>Jumlah Tanggungan</td>   <td> : <input type=text id='jlh_tanggungan' name='jlh_tanggungan' size=30 value='$r[jlh_tanggungan]'></td></tr>
          <tr><td> <tr><td>Pekerjaan</td>   <td> : <input type=text id='pekerjaan' name='pekerjaan' size=30'value='$r[pekerjaan]' ></td></tr></td></tr>
		      <tr><td></td><td>
		  <input type=submit name=submit value='Simpan'>
		  <input type=button name=batal value='Batal' onclick=\"window.location.href='?module=pemohon';\"></td></tr>
          </table></form>";
    break;  
}
?>
