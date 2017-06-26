<?php
$link_update='?module=penilaianp';

$pemohon=array();
$q="select * from pemohon order by id_pemohon";
$q=mysql_query($q);
while($h=mysql_fetch_array($q)){
	$pemohon[]=array($h['id_pemohon'],$h['id_pemohon'],$h['nama']);
}
$id_kriteria='';
if(isset($_POST['kriteria'])){
	$id_kriteria=$_POST['kriteria'];
}
if(isset($_POST['save'])){
	$id_kriteria=$_POST['kriteria'];
	mysql_query("delete from nilai_pemohon where id_kriteria='".$id_kriteria."'"); /* kosongkan tabel nilai_kk berdasarkan kriteria */
	for($i=0;$i<count($pemohon);$i++){
		for($ii=0;$ii<count($pemohon);$ii++){
			if($i < $ii){
				mysql_query("insert into nilai_pemohon(id_kriteria,id_pemohon_1,id_pemohon_2,nilai) values('".$id_kriteria."','".$pemohon[$i][0]."','".$pemohon[$ii][0]."','".$_POST['nilai_'.$pemohon[$i][0].'_'.$pemohon[$ii][0]]."')");
			}
		}
	}
	$success='Nilai perbandingan pemohon disimpan.';
}
if(isset($_POST['reset'])){
	$id_kriteria=$_POST['kriteria'];
	mysql_query("delete from nilai_pemohon where id_kriteria='".$id_kriteria."'"); /* kosongkan tabel nilai_pemohon berdasarkan kriteria */
}

for($i=1;$i<=9;$i++){
	$selected[$i]='';
}
$daftar='';
$counter = 1;
for($i=0;$i<count($pemohon);$i++){
	for($ii=0;$ii<count($pemohon);$ii++){
		if($i < $ii){
			$q=mysql_query("select nilai from nilai_pemohon where id_kriteria='".$id_kriteria."' and id_pemohon_1='".$pemohon[$i][0]."' and id_pemohon_2='".$pemohon[$ii][0]."'");
			if(mysql_num_rows($q)>0){
				$h=mysql_fetch_array($q);
				$nilai=$h['nilai'];
			}else{
				mysql_query("insert into nilai_pemohon(id_kriteria,id_pemohon_1,id_pemohon_2,nilai) values('".$id_kriteria."','".$pemohon[$i][0]."','".$pemohon[$ii][0]."','1')");
				$nilai=1;
			}
			$selected[$nilai]='selected';
			if ($counter % 2 == 0) $warna = "light";
			else $warna = "dark";
			$daftar.='
			  <tr class="'.$warna.'">
				<td align="right">'.$pemohon[$i][2].'</td>
				<td align="center"><select name="nilai_'.$pemohon[$i][0].'_'.$pemohon[$ii][0].'">
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
				<td>'.$pemohon[$ii][2].'</td>
			  </tr>
			';
			$selected[$nilai]='';
			$counter++;
		}
	}
}

$list_kriteria=array();
$q="select * from kriteria order by id_kriteria";
$q=mysql_query($q);
while($h=mysql_fetch_array($q)){
	if($h['id_kriteria']==$id_kriteria){$s=' selected';}else{$s='';}
	$list_kriteria.='<option value="'.$h['id_kriteria'].'"'.$s.'>'.$h['nama_kriteria'].'</option>';
}

?>
<script language="javascript">
function ResetConfirm(){
	if (confirm("Anda yakin akan mengatur ulang semua nilai perbandingan Pemohon ini ?")){
		return true;
	}else{
		return false;
	}
}
</script>

<form action="<?php echo $link_update;?>" name="" method="post" enctype="multipart/form-data">

<table cellpadding='0' cellspacing='0'>
	<tbody>
		<tr><td><text align='center'><h6 class='red'>Kriteria : <select name="kriteria" class="medium m-wrap" onchange="submit()"><?php echo $list_kriteria;?></select></td></h6>
			
		</tr>
	</tbody>
</table>
</form>

<form action="<?php echo $link_update;?>" name="" method="post" enctype="multipart/form-data">
<input name="kriteria" type="hidden" value="<?php echo $id_kriteria;?>" />
<?php
if(!empty($success)){
	echo '
	   <div class="alert alert-success ">
		  '.$success.'
	   </div>
	';
}
?>

<table cellpadding='0' cellspacing='0'>

	<thead>
		<tr>
			<th>Nama Pemohon</th>
			<th>Nilai Perbandingan</th>
			<th>Nama Pemohon</th>
		</tr>
	</thead>
	<tbody>

		<?php echo $daftar;?>
	  <tr>
		<td align="center" colspan="3"><button type="submit" name="save" class="btn blue"><i class="icon-ok"></i> Simpan</button>
		<button type="submit" name="reset" class="btn" onclick="return(ResetConfirm());">Reset Nilai</button></td>
	  </tr>
	</tbody>
</table>
</form>