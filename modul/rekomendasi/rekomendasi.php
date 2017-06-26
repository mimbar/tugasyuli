<?php
require_once ( 'ahp.php' );

$kriteria=array();
$q="select * from kriteria order by id_kriteria";
$q=mysql_query($q);
while($h=mysql_fetch_array($q)){
	$kriteria[]=array($h['id_kriteria'],$h['id_kriteria'],$h['nama_kriteria']);
}
$kk=array();
$q="select * from pemohon order by id_pemohon";
$q=mysql_query($q);
while($h=mysql_fetch_array($q)){
	$kk[]=array($h['id_pemohon'],$h['id_pemohon'],$h['nama'],$h['no_ktp']);
}

for($i=0;$i<count($kriteria);$i++){
	$id_kriteria[]=$kriteria[$i][0];
}
$matrik_kriteria = ahp_get_matrik_kriteria($id_kriteria);
$jumlah_kolom = ahp_get_jumlah_kolom($matrik_kriteria);
$matrik_normalisasi = ahp_get_normalisasi($matrik_kriteria, $jumlah_kolom);
$eigen_kriteria = ahp_get_eigen($matrik_normalisasi);

for($i=0;$i<count($kk);$i++){
	$id_kk[]=$kk[$i][0];
}
for($i=0;$i<count($kriteria);$i++){
	$matrik_kk = ahp_get_matrik_kk($kriteria[$i][0], $id_kk);
	$jumlah_kolom_kk = ahp_get_jumlah_kolom($matrik_kk);
	$matrik_normalisasi_kk = ahp_get_normalisasi($matrik_kk, $jumlah_kolom_kk);
	$eigen_kk[$i] = ahp_get_eigen($matrik_normalisasi_kk);
}

$nilai_to_sort = array();
mysql_query("truncate table nilai_hasil");
for($i=0;$i<count($kk);$i++){
	$nilai=0;
	for($ii=0;$ii<count($kriteria);$ii++){
		$nilai = $nilai + ( $eigen_kk[$ii][$i] * $eigen_kriteria[$ii]);
	}
	$idkk = $kk[$i][0];
	$nilai = round( $nilai , 4);
	$nilai_global[$i] = $nilai;
	$nilai_to_sort[] = array($nilai, $kk[$i][0]);
	mysql_query("INSERT INTO nilai_hasil(
			      id_pemohon,nilai) 
	        VALUES(
				'$idpemohon','$nilai')");
}

sort($nilai_to_sort);
for($i=0;$i<count($nilai_to_sort);$i++){
	$ranking[$nilai_to_sort[$i][1]]=(count($nilai_to_sort) - $i);
}


?>

<table cellpadding='0' cellspacing='0'>
	<thead>
		<tr>
			<th colspan="50">HASIL PENILAIAN</th>
		</tr>
		<tr>
			<th>No KTP</th>
			<th>Nama Pemohon</th>
			<?php
			for($i=0;$i<count($kriteria);$i++){
				echo '<th style="text-align:center;">'.strtoupper($kriteria[$i][2]).'</th>';
			}
			?>
			<th style="text-align:center;">NILAI</th>
			<th style="text-align:center;">REKOMENDASI</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$counter = 1;
		for($i=0;$i<count($kk);$i++){
			if ($counter % 2 == 0) $warna = "light";
			else $warna = "dark";
			echo '
				<tr class="'.$warna.'">
					<td style="text-align:center;">'.$kk[$i][3].'</td>
					<td>'.$kk[$i][2].'</td>
			';
			for($ii=0;$ii<count($kriteria);$ii++){
				echo '
						<td style="text-align:center;">'.$eigen_kk[$ii][$i].'</td>
				';
				
			}
			echo '
					<td style="text-align:center;"><strong>'.$nilai_global[$i].'</strong></td>
					<td style="text-align:center;">'.$ranking[$kk[$i][0]].'</td>
				</tr>
			';
			$counter++;
		}
		?>
	</tbody>
</table>