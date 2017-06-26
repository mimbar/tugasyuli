<?php
$link_update='?module=penilaian';
$kriteria=array();
$q="select * from kriteria order by id_kriteria";
$q=mysql_query($q);
while($h=mysql_fetch_array($q)){
	$kriteria[]=array($h['id_kriteria'],$h['id_kriteria'],$h['nama_kriteria']);
}

if(isset($_POST['save'])){
	mysql_query("truncate table nilai_kriteria"); /* kosongkan tabel nilai_kriteria */
	for($i=0;$i<count($kriteria);$i++){
		for($ii=0;$ii<count($kriteria);$ii++){
			if($i < $ii){
				mysql_query("insert into nilai_kriteria(id_kriteria_1,id_kriteria_2,nilai) values('".$kriteria[$i][0]."','".$kriteria[$ii][0]."','".$_POST['nilai_'.$kriteria[$i][0].'_'.$kriteria[$ii][0]]."')");
			}
		}
	}
	$success='Nilai perbandingan kriteria berhasil disimpan.';
}
if(isset($_POST['check'])){
	require_once ( 'ahp.php' );
	for($i=0;$i<count($kriteria);$i++){
		$id_kriteria[]=$kriteria[$i][0];
	}
	
	$matrik_kriteria = ahp_get_matrik_kriteria($id_kriteria);
	$jumlah_kolom = ahp_get_jumlah_kolom($matrik_kriteria);
	$matrik_normalisasi = ahp_get_normalisasi($matrik_kriteria, $jumlah_kolom);
	$eigen = ahp_get_eigen($matrik_normalisasi);
	
	if(ahp_uji_konsistensi($matrik_kriteria, $eigen)){
		$success='Nilai perbandingan : KONSISTEN';
	}else{
		$error='Nilai perbandingan : TIDAK KONSISTEN';
	}
	
	
	
}
if(isset($_POST['reset'])){
	mysql_query("truncate table nilai_kriteria"); /* kosongkan tabel nilai_kriteria */
}
for($i=1;$i<=9;$i++){
	$selected[$i]='';
}
$daftar='';
$counter = 1;
for($i=0;$i<count($kriteria);$i++){
	for($ii=0;$ii<count($kriteria);$ii++){
		if($i < $ii){
			$q=mysql_query("select nilai from nilai_kriteria where id_kriteria_1='".$kriteria[$i][0]."' and id_kriteria_2='".$kriteria[$ii][0]."'");
			if(mysql_num_rows($q)>0){
				$h=mysql_fetch_array($q);
				$nilai=$h['nilai'];
			}else{
				mysql_query("insert into nilai_kriteria(id_kriteria_1,id_kriteria_2,nilai) values('".$kriteria[$i][0]."','".$kriteria[$ii][0]."','1')");
				$nilai=1;
			}
			
			$selected[$nilai]=' selected';
			if ($counter % 2 == 0) $warna = "light";
			else $warna = "dark";
			$daftar.='
			  <tr class="'.$warna.'">
				<td align="right">'.$kriteria[$i][1].' - '.$kriteria[$i][2].'</td>
				<td align="center"><select name="nilai_'.$kriteria[$i][0].'_'.$kriteria[$ii][0].'">
				<option value="1"'.$selected[1].'>1. Sama penting dengan</option>
				<option value="2"'.$selected[2].'>2. Mendekati sedikit lebih penting dari</option>
				<option value="3"'.$selected[3].'>3. Sedikit lebih penting dari</option>
				<option value="4"'.$selected[4].'>4. Mendekati lebih penting dari</option>
				<option value="5"'.$selected[5].'>5. Lebih penting dari</option>
				<option value="6"'.$selected[6].'>6. Mendekati sangat penting dari</option>
				<option value="7"'.$selected[7].'>7. Sangat penting dari</option>
				<option value="8"'.$selected[8].'>8. Mendekati mutlak dari</option>
				<option value="9"'.$selected[9].'>9. Mutlak sangat penting dari</option>
				</select></td>
				<td>'.$kriteria[$ii][1].' - '.$kriteria[$ii][2].'</td>
			  </tr>
			';
			$selected[$nilai]='';
			$counter++;
		}
	}
}


?>
<script language="javascript">
function ResetConfirm(){
	if (confirm("Anda yakin akan mengatur ulang semua nilai perbandingan kriteria ini ?")){
		return true;
	}else{
		return false;
	}
}
</script>



<form action="<?php echo $link_update;?>" name="" method="post" enctype="multipart/form-data">
<?php
if(!empty($error)){
	echo '
	   <div class="alert alert-error ">
		  '.$error.'
	   </div>
	';
}
if(!empty($success)){
	echo '
	   <div class="alert alert-success ">
		  '.$success.'
	   </div>
	';
}
?>

<table cellpadding='0' cellspacing='0'>
<tr><text align='center'><h6 class='red'>Nilai Perbandingan Kriteria</tr></h6>
	<thead>
		<tr>
			<th>Nama Kriteria</th>
			<th>Nilai Perbandingan</th>
			<th>Nama Kriteria</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $daftar;?>
	  <tr>
		<td align="center" colspan="3"><button type="submit" name="save" class="btn blue"><i class="icon-ok"></i> Simpan</button>
		<button type="submit" name="check" class="btn">Cek Konsistensi</button>
		<button type="submit" name="reset" class="btn" onclick="return(ResetConfirm());">Reset Nilai</button></td>
	  </tr>
	</tbody>
</table>
</form>