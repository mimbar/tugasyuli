<script Language="JavaScript">
<!-- 
function Blank_TextField_Validator()
{
if (text_form.nama_kriteria.value == "")
{
   alert("Nama Kriteria tidak boleh kosong !");
   text_form.nama_kriteria.focus();
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
$aksi="modul/kriteria/aksi_kriteria.php";
switch($_GET[act]){
	
  default:
  $offset=$_GET['offset'];
	
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
	$baris=mysql_num_rows($tampil);
	echo "<text align=center>";
	echo "<br><form method=POST action='?module=kriteria' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
          <table>
		  <tr><td><h6 class='red'> Cari Data kriteria </td></tr></h6>
		  <tr><td><h6 class='red'>Nama Kriteria : <input type=text name='keyword' id='keyword' /> <input type=submit value='   Cari   ' name=Go></td> </tr>
          </table></form></h6>";
		  
	if ($_POST[Go]){
			$numrows = mysql_num_rows(mysql_query("SELECT * FROM kriteria where nama_kriteria like '%$_POST[keyword]%'"));
			if ($numrows > 0){
				echo "<p>Hasil Pencarian: <b>Ditemukan</b></p>";
				$i = 1;
	echo" <table cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Kriteria</th>
              <th>Aksi</th>
            </tr>
          </thead>
		  <tbody>"; 
	$hasil = mysql_query("SELECT * FROM kriteria where nama_kriteria like '%$_POST[keyword]%'");
	$no = 1;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "light";
	else $warna = "dark";
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
	         <td>$r[nama_kriteria]</td>
			 <td align=center><a href=?module=kriteria&act=editkriteria&id=$r[id_kriteria]>Ubah</a> &nbsp;
	          <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=kriteria&act=hapus&id=$r[id_kriteria]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">Hapus</a>
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
	echo "<input type=button name=tambah value='Tambah Kriteria' onclick=\"window.location.href='?module=kriteria&act=tambahkriteria';\"><br>";
	if($baris>0){
	echo" <p><table cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Kriteria</th>
              <th>Aksi</th>
            </tr>
          </thead>
		  <tbody>
		  "; 
	$hasil = mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "light";
	else $warna = "dark";
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
	         <td>$r[nama_kriteria]</td>
			 <td align=center>
			 <a href=?module=kriteria&act=editkriteria&id=$r[id_kriteria]>Ubah</a> &nbsp;
	          <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=kriteria&act=hapus&id=$r[id_kriteria]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">Hapus</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=index.php?module=kriteria&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=index.php?module=kriteria&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=index.php?module=kriteria&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
	}else{
	echo "<br><b>Tidak Ada Data Kriteria !</b>";
	}
	}
    break;
  
  case "tambahkriteria":
    echo "<h6 class='red'>Tambah Data Kriteria</h6>
          <form name=text_form method=POST action='$aksi?module=kriteria&act=input' onsubmit='return Blank_TextField_Validator()'>
          <table>
          <tr><td>Nama Kriteria</td>   <td> : <input type=text id='nama_kriteria' name='nama_kriteria' size=30></td></tr>
		  <tr><td></td><td>
		  <input type=submit name=submit value='Simpan' >
		  <input type=button name=batal value='Batal' onclick=\"window.location.href='?module=kriteria';\">
		  </td></tr>
          </table></form>";
     break;
    
  case "editkriteria":
    $edit=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
    echo "<h6 class='red'>Edit Data Kriteria</h6>
          <form name=text_form method=POST action='$aksi?module=kriteria&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[id_kriteria]'>
          <table>
	      <tr><td>Nama Kriteria</td> <td> : <input type=text id='nama_kriteria' name='nama_kriteria' value=\"$r[nama_kriteria]\" size=30></td></tr>
          <tr><td></td><td>
		  <input type=submit name=submit value='Simpan' >
		  <input type=button name=batal value='Batal' onclick=\"window.location.href='?module=kriteria';\"></td></tr>
          </table></form>";
    break;  
}
?>
