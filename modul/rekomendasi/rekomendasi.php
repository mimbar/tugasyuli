<?php
require_once ( 'ahp.php' );
require_once('modul/rekomendasi/fungsi.php');


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
			<th style="text-align:center;">NILAI AKHIR</th>
			<th style="text-align:center;">REKOMENDASI</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$counter = 1;
		$nilaiakhir = 0;
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

				$nilaiakhir = $nilaiakhir + $eigen_kk[$ii][$i];
				
			}
			echo '
					<td style="text-align:center;"><strong>'.$nilai_global[$i].'</strong></td>
					<td style="text-align:center;"><strong>'.$nilaiakhir.'</strong></td>
					<td style="text-align:center;">'.$ranking[$kk[$i][0]].'</td>
				</tr>
			';
			$nilaiakhir=0;
			$counter++;
		}
		?>
	</tbody>
</table>